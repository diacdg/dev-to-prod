<?php declare(strict_types=1);

namespace App\Domain\File;

use App\Domain\Entity\File;
use App\Domain\File\UploadedFileInterface;
use App\Domain\Manager\EntityManagerInterface;

interface FileCreatorInterface
{
    public function __construct(EntityManagerInterface $entityManager);

    public function saveFile(UploadedFileInterface $uploadedFile): File;
}
