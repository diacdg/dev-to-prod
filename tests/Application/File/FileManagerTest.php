<?php

namespace App\Tests\Application\File;

use App\Application\File\FileCreator;
use App\Domain\File\UploadedFileInterface;
use App\Domain\Manager\EntityManagerInterface;
use App\Infrastructure\Symfony\File\UploadedFileDecorator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerTest extends TestCase
{

    public function testSaveFile()
    {
        $entityManager = $this->createEntityManagerMock();
        $entityManager->expects($this->once())
            ->method('flush');
        $entityManager->expects($this->once())
            ->method('persist');

        $uploadedFile = $this->createUploadedFile();
        $fileCreator = new FileCreator($entityManager);

        $file = $fileCreator->saveFile($uploadedFile);

        $this->assertEquals($file->getPath(), 'var/upload/test.txt');
        $this->assertEquals($file->getName(), 'test');
    }

    private function createUploadedFile(): UploadedFileInterface
    {
        $uploadedFileMock = $this->createMock(UploadedFile::class);

        $uploadedFileMock->expects($this->any())
            ->method('getPath')
            ->willReturn('var/upload/test.txt');

        $uploadedFileMock->expects($this->any())
            ->method('getFilename')
            ->willReturn('test');

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
