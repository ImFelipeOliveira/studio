<?php

namespace App\Entity\Enum;


enum StudioTypeEnum: string
{
  case SOLO = "SOLO";
  case STUDIO = "STUDIO";

  public function getLabel(): string
  {
    return match ($this) {
      StudioTypeEnum::SOLO => 'Solo',
      StudioTypeEnum::STUDIO => 'Estúdio',
    };
  }
}