<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
final class PersistentMessage
{
    #[Id, GeneratedValue, Column(type: 'integer')]
    public $id;

    #[Column(type: 'integer')]
    public $sequence;
}
