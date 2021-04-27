<?php declare(strict_types=1);

namespace App\Infrastructure\Symfony\File;

use App\Domain\File\UploadedFileInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileDecorator implements UploadedFileInterface
{
    /** @var UploadedFile  */
    private $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    public function getPath(): string
    {
        return $this->uploadedFile->getPath();
    }

    public function getFilename(): string
    {
        return $this->uploadedFile->getFilename();
    }

    public function getClientOriginalName(): string
    {
        return $this->uploadedFile->getClientOriginalName();
    }

    public function move(string $directory, string $name = null): void
    {
        $this->uploadedFile->move($directory, $name);
    }
}
