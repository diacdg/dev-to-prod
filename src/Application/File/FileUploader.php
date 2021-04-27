<?php declare(strict_types=1);

namespace App\Application\File;

use App\Domain\Entity\File;
use App\Domain\File\UploadedFileInterface;
use App\Domain\Manager\EntityManagerInterface;
use App\Domain\File\FileUploaderInterface;

class FileUploader implements FileUploaderInterface
{
    private EntityManagerInterface $entityManager;

    private string $uploadPath;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $uploadPath
    ) {
        $this->entityManager = $entityManager;
        $this->uploadPath = $uploadPath;
    }

    public function saveFile(UploadedFileInterface $uploadedFile): File
    {
        $uploadedFile->move($this->uploadPath);

        $file = (new File())
            ->setPath($this->uploadPath . '/' . $uploadedFile->getFilename())
            ->setName($uploadedFile->getClientOriginalName());

        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return $file;
    }
}
