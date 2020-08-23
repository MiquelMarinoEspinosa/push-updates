<?php

namespace RealTime\Command;

use Symfony\Component\Mercure\Update;

class RealTimeUpdate
{
  private Update $update;

  public function __construct(Update $update)
  {
    $this->update = $update;
  }

  public function getUpdate(): Update
  {
    return $this->update;
  }
}