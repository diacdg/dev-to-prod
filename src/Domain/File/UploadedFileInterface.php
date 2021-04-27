<?php

namespace App\Domain\File;

interface UploadedFileInterface
{
    public function getPath(): string;

    public function getFilename(): string;

    public function getClientOriginalName(): string;

    public function move(string $directory, string $name = null): void;
}