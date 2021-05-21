<?php declare(strict_types=1);

namespace App\Domain\File;

use App\Domain\Entity\File;

interface FileUploaderInterface
{
    public function saveFile(UploadedFileInterface $uploadedFile): File;
}
