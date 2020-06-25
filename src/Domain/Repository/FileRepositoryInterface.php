<?php declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\File;

interface FileRepositoryInterface
{
    public function find(int $id): ?File;
}
