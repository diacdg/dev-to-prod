<?php declare(strict_types=1);

namespace App\Application\File;

use App\Domain\Entity\File;
use App\Domain\File\UploadedFileInterface;
use App\Domain\Manager\EntityManagerInterface;
use App\Domain\File\FileCreatorInterface;

class FileCreator implements FileCreatorInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveFile(UploadedFileInterface $uploadedFile): File
    {
        $uploadedFile->move('/Users/doru.diaconescu/Projects/tutorial/var/upload/procesed');

        $file = (new File())
            ->setPath($uploadedFile->getPath())
            ->setName($uploadedFile->getFilename());

        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return $file;
    }
}
