<?php

namespace App\Tests\Application\File;

use App\Application\File\FileUploader;
use App\Domain\File\UploadedFileInterface;
use App\Domain\Manager\EntityManagerInterface;
use App\Infrastructure\Symfony\File\UploadedFileDecorator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderTest extends TestCase
{

    public function testSaveFile()
    {
        $uploadPath = "test/upload/dir";

        $entityManager = $this->createEntityManagerMock();
        $entityManager->expects($this->once())
            ->method('flush');
        $entityManager->expects($this->once())
            ->method('persist');

        $uploadedFile = $this->createUploadedFile();
        $fileCreator = new FileUploader($entityManager, $uploadPath);

        $file = $fileCreator->saveFile($uploadedFile);

        $this->assertEquals($file->getPath(), $uploadPath . '/test-name');
        $this->assertEquals($file->getName(), 'test-original-name');
    }

    private function createUploadedFile(): UploadedFileInterface
    {
        $uploadedFileMock = $this->createMock(UploadedFile::class);

        $uploadedFileMock->method('getPath')
            ->willReturn('var/upload/test.txt');

        $uploadedFileMock->method('getFilename')
            ->willReturn('test-name');

        $uploadedFileMock->method('getClientOriginalName')
            ->willReturn('test-original-name');

        $uploadedFileMock->expects($this->once())
            ->method('move');

        $uploadedFile = new UploadedFileDecorator($uploadedFileMock);

        return $uploadedFile;
    }

    private function createEntityManagerMock(): EntityManagerInterface
    {
        return $this->createMock(EntityManagerInterface::class);
    }
}
