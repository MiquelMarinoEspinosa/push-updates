<?php

namespace RealTime\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Console\Input\InputArgument;
use RealTime\Command\RealTimeUpdate;

class RealTimeAsyncPublisher extends Command
{
  private MessageBusInterface $bus;

  protected static $defaultName = 'real-time:publish-async';

  public function __construct(MessageBusInterface $bus)
  {
    $this->bus = $bus;
    parent::__construct();
  }

  protected function configure()
  {
    $this
        ->setDescription('Publish a real-time async message')
        ->addArgument('message', InputArgument::REQUIRED, 'The meesage content to be publish');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $messageContent = json_encode(
      [
          'message' => $input->getArgument('message'),
          'type' => 'async',
          'date' => date('d-m-Y H:i:s')
      ]
    );
    
    $update = new Update(
      'http://example.com/test',
      $messageContent
    );
    
    $this->bus->dispatch(new RealTimeUpdate($update));
    $output->write('<info>Message content: </info>');
    $output->writeln('<info>' . $messageContent . '</info>');
    $output->writeln('<info>The message has been sent!</info>');
    $output->writeln('<info>Consume the message from the queue to transfer it executing the command:</info>');
    $output->writeln('<info>bin/console messenger:consume</info>');
    return Command::SUCCESS;

  }
}