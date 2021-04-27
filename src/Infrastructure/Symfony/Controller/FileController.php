<?php declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\File\FileUploaderInterface;
use App\Infrastructure\Symfony\File\UploadedFileDecorator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController
{
    /** @var FileUploaderInterface */
    private $fileUploader;

    public function __construct(FileUploaderInterface $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    /**
     * @Route("/api/file", name="api_upload_file", methods={"post"})
     */
    public function uploadAction(Request $request): JsonResponse
    {
        if (!$request->files->has('attachment')) {
            return new JsonResponse(
                [
                    'message' => 'Invalid request. Attachment is required.',
                ], Response::HTTP_BAD_REQUEST,
            );
        }

        $uploadedFile = new UploadedFileDecorator($request->files->get('attachment'));

        $file = $this->fileUploader->saveFile($uploadedFile);

        return new JsonResponse(['file' => $file->getId()], Response::HTTP_CREATED);
    }
}
