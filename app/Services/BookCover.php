<?php

namespace App\Services;

use App\Models\Book;
use Core\Constants\Constants;

class BookCover
{
    /** @var array<string, mixed> $image */
    private array $image;

    /** @param array<string, mixed> $validations */
    public function __construct(
        private Book $model,
        private array $validations = []
    ) {
    }

    public function path(): string
    {
        if ($this->model->cover_name) {
            $filePath = $this->getAbsoluteSavedFilePath();

            if (file_exists($filePath)) {
                $hash = md5_file($filePath);
                return $this->baseDir() . $this->model->cover_name . '?' . $hash;
            }
        }
        return "/assets/images/defaults/genbook.png";
    }

    /**
     * @param array<string, mixed> $image
     */
    public function update(array $image): bool
    {
        $this->image = $image;

        if (!$this->isValidImage()) {
            return false;
        }

        if ($this->updateFile()) {
            $this->model->update([
                'cover_name' => $this->getFileName(),
            ]);

            return true;
        }

        return false;
    }

    protected function updateFile(): bool
    {
        if (empty($this->getTmpFilePath())) {
            return false;
        }

        $this->removeOldImage();

        $resp = move_uploaded_file(
            $this->getTmpFilePath(),
            $this->getAbsoluteDestinationPath()
        );

        if (!$resp) {
            $error = error_get_last();
            throw new \RuntimeException(
                'Failed to move uploaded file: ' . ($error['message'] ?? 'Unknown error')
            );
        }

        return true;
    }

    private function getTmpFilePath(): string
    {
        return $this->image['tmp_name'];
    }

    private function removeOldImage(): void
    {
        if ($this->model->cover_name) {
            unlink($this->getAbsoluteSavedFilePath());
        }
    }

    private function getFileName(): string
    {
        $file_name_splitted  = explode('.', $this->image['name']);
        $file_extension = end($file_name_splitted);
        return 'cover.' . $file_extension;
    }

    private function getAbsoluteDestinationPath(): string
    {
        return $this->storeDir() . $this->getFileName();
    }

    private function baseDir(): string
    {
        return "/assets/uploads/{$this->model::table()}/{$this->model->id}/";
    }

    private function storeDir(): string
    {
        $path = Constants::rootPath()->join('public' . $this->baseDir());
        if (!is_dir($path)) {
            mkdir(directory: $path, recursive: true);
        }

        return $path;
    }

    private function getAbsoluteSavedFilePath(): string
    {
        return Constants::rootPath()->join('public' . $this->baseDir())->join($this->model->cover_name);
    }

    private function isValidImage(): bool
    {
        if (isset($this->validations['extension'])) {
            $this->validateImageExtension();
        }

        if (isset($this->validations['size'])) {
            $this->validateImageSize();
        }

        return $this->model->errors('cover') === null;
    }

    private function validateImageExtension(): void
    {
        $file_name_splitted  = explode('.', $this->image['name']);
        $file_extension = end($file_name_splitted);

        if (!in_array($file_extension, $this->validations['extension'])) {
            $this->model->addError('cover', 'Extensão de arquivo inválida');
        }
    }

    private function validateImageSize(): void
    {
        if ($this->image['size'] > $this->validations['size']) {
            $this->model->addError('cover', 'Tamanho do arquivo inválido');
        }
    }
}
