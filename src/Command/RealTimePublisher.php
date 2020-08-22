<?php

namespace RealTime\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;

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
        ->setDescription('Publish a real-time message');
  }
  
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $update = new Update(
      'http://example.com/books/1',
      json_encode(['status' => 'OutOfStock'])
    );
    ($this->publisher)($update);
    $output->writeln('<info>Success!!</info>');
    return Command::SUCCESS;
  }
}