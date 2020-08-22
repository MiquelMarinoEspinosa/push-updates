<?php

namespace RealTime\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RealTimePublisher extends Command
{
  protected static $defaultName = 'real-time:publish';
  protected function configure()
  {
    $this
        ->setDescription('Publish a real-time message');
  }
  
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('<info>Success!!</info>');
    return Command::SUCCESS;
  }
}