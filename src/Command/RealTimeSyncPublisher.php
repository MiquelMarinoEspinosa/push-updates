<?php

namespace RealTime\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Console\Input\InputArgument;

class RealTimeSyncPublisher extends Command
{
  private PublisherInterface $publisher;
  public function __construct(PublisherInterface $publisher) {
    $this->publisher = $publisher;
    parent::__construct();
  }

  protected static $defaultName = 'real-time:publish-sync';
  protected function configure()
  {
    $this
        ->setDescription('Publish a real-time message')
        ->addArgument('message', InputArgument::REQUIRED, 'The meesage content to be publish');
  }
  
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $messageContent = json_encode(
      [
          'message' => $input->getArgument('message'),
          'type' => 'sync',
          'date' => date('d-m-Y H:i:s')
      ]
    );
    
    $update = new Update(
      'http://example.com/test',
      $messageContent
    );
    
    ($this->publisher)($update);
    $output->write('<info>Message content: </info>');
    $output->writeln('<info>' . $messageContent . '</info>');
    $output->writeln('<info>The message has been sent!</info>');
    return Command::SUCCESS;
  }
}