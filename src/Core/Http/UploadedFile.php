<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use RuntimeException;

class UploadedFile implements UploadedFileInterface
{
    public function __construct(
        readonly private string $file,
        readonly private ?int $error = 0,
        readonly private ?int $size = 0,
        readonly private ?string $type = null,
        readonly private ?string $name = null,
    )
    {
    }

    public function moveTo(string $targetPath): bool
    {
        if (realpath($targetPath)) {
            if (!unlink($targetPath)) {
                throw new RuntimeException('The target file already exists.');
            }
        } elseif (!realpath($path = dirname($targetPath))) {
            if (!mkdir($path, 0777, true)) {
                throw new RuntimeException('The target path is non-writeable.');
            }
        }

        if (is_uploaded_file($this->file)) {
            return move_uploaded_file($this->file, $targetPath);
        } else {
            return rename($this->file, $targetPath);
        }
    }

    /**
     * @return int
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getClientFilename(): ?string
    {
        return $this->name;
    }

    public function getClientMediaType(): ?string
    {
        return $this->type;
    }

    public function getStream(): StreamInterface
    {
        return Stream::open($this->file);
    }
}