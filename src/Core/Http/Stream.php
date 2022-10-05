<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Psr\Http\Message\StreamInterface;
use InvalidArgumentException;

class Stream implements StreamInterface
{
    private mixed $stream = null;

    public function __construct(mixed $stream)
    {
        if(is_null($stream) || (is_resource($stream) && (get_resource_type($stream)==='stream'))) {
            $this->stream = $stream;
        }

        throw new InvalidArgumentException('Invalid stream resource');
    }

    public static function open(string $file, ?string $mode=null): static
    {
        return new static(fopen($file, $mode?:'r'));
    }

    public function __toString(): string
    {
        return $this->getContents();
    }

    public function close(): void
    {
        fclose($this->stream);
    }

    public function detach(): mixed
    {
        $resource = $this->stream;
        $this->stream = null;
        return $resource;
    }

    public function getSize(): ?int
    {
        return null;
    }

    public function tell(): int
    {
        return ftell($this->stream);
    }

    public function eof(): bool
    {
        return feof($this->stream);
    }

    public function isSeekable(): bool
    {
        return $this->getMetadata('seekable');
    }

    public function seek(int $offset, int $whence = SEEK_SET): void
    {
        fseek($this->stream, $offset, $whence);
    }

    public function rewind(): void
    {
        rewind($this->stream);
    }

    public function isWritable(): bool
    {
        return str_contains((string)$this->getMetadata('mode'), 'w');
    }

    public function write(string $string): int
    {
        return fwrite($this->stream, $string);
    }

    public function isReadable(): bool
    {
        return str_contains((string)$this->getMetadata('mode'), 'r');
    }

    public function read(int $length): string
    {
        return fread($this->stream, $length);
    }

    public function getContents(): string
    {
        return stream_get_contents($this->stream);
    }

    public function getMetadata(string $key = null): mixed
    {
        return stream_get_meta_data($this->stream)[$key]??null;
    }
}