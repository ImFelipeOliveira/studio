<?php

namespace App\Entity\Enum;

enum ArtistRoleEnum: string
{
  case OWNER = "OWNER";
  case ARTIST = "ARTIST";

  public function getLabel(): string
  {
    return match($this) {
      ArtistRoleEnum::OWNER => 'Dono',
      ArtistRoleEnum::ARTIST => 'Artista',
    };
  }
}