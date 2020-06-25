<?php declare(strict_types=1);

namespace App\Domain\Manager;

interface EntityManagerInterface
{
    public function persist(object $entity): void;

    public function flush(): void;
}
