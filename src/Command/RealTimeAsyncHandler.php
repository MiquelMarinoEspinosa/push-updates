<?php

namespace RealTime\Command;

use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use RealTime\Command\RealTimeUpdate;
use Symfony\Component\Mercure\PublisherInterface;

class RealTimeAsyncHandler implements MessageSubscriberInterface
{
  private PublisherInterface $publisher;
  
  public function __construct(PublisherInterface $publisher)
  {
    $this->publisher = $publisher;
  }

  public function __invoke(RealTimeUpdate $realTimeUpdate)
  {
    ($this->publisher)($realTimeUpdate->getUpdate());
  }

  public static function getHandledMessages(): iterable
  {
    yield RealTimeUpdate::class;
  }
}