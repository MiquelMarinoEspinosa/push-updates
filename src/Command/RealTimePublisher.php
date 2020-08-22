<?php

namespace RealTime\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Console\Input\InputArgument;

class RealTimePublisher extends Command
{
  private PublisherInterface $publisher;
  public function __construct(PublisherInterface $publisher) {
    $this->publisher = $publisher;
    parent::__construct();
  }

  protected static $defaultName = 'real-time:publish';
  protected function configure()
  {
    $this
        ->setDescription('Publish a real-time message')
        ->addArgument('message', InputArgument::REQUIRED, 'The meesage content to be publish');
  }
  
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $update = new Update(
      'http://example.com/test',
      json_encode(['message' => $input->getArgument('message')])
    );
    ($this->publisher)($update);
    $output->writeln('<info>Message sent</info>');
    return Command::SUCCESS;
  }
}