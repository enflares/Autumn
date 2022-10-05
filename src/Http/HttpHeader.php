<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/23
 */

namespace Autumn\Http;

use Autumn\Core\Http\ServerResponse;
use DateTime;
use Autumn\Lang\Cast;
use Stringable;

class HttpHeader implements Stringable
{
    public const VALUE_SEPARATOR = ', ';

    private array $values;

    /**
     * @var HttpHeader[]
     */
    private array $correspondences = [];

    public function __construct(private string $name, int|float|string|array|DateTime|Stringable|null $value=null, int|float|string|DateTime|Stringable ...$values)
    {
        $this->values = Cast::toArray($value);
        $this->append(...$values);
    }

    public function apply(ServerResponse $response): void
    {
        $response->setHeader($this->getName(), $this->getValue());

        foreach ($this->getCorrespondences() as $correspondence) {
            $correspondence?->apply($response);
        }
    }

    public static function formatDateTime(DateTime $dateTime): string
    {
        return $dateTime->format('D, d M Y H:i:s') . ' GMT';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getValue(): string
    {
        $values = [];
        foreach ($this->values as $name => $value) {
            if (is_null($value)) continue;

            if (is_string($name)) {
                if ($value === true) {
                    $values[] = $name;
                } else {
                    $values[] = "$name=$value";
                }
            } else {
                $values[] = $value;
            }
        }
        return implode(static::VALUE_SEPARATOR, $values);
    }

    /**
     * @param int|float|string|DateTime|Stringable|mixed ...$values
     */
    public function setValues(int|float|string|DateTime|Stringable ...$values): void
    {
        $this->values = $values;
    }

    public function setValue(int|float|string|DateTime|Stringable|null $value, string $name = null): void
    {
        if ($value instanceof DateTime) {
            $value = static::formatDateTime($value);
        }

        if ($name) {
            $this->values[$name] = $value;
        } elseif (!is_null($value)) {
            $this->values = [$value];
        } else {
            $this->values = [];
        }
    }

    public function getNamedValue(string $name): mixed
    {
        return $this->values[$name] ?? null;
    }

    public function setNamedValue(string $name, int|float|string|DateTime|Stringable|null $value): void
    {
        $this->setValue($name, $value);
    }

    public function addValue(int|float|string|DateTime|Stringable|null $value): void
    {
        if ($value instanceof DateTime) {
            $value = static::formatDateTime($value);
        }

        $this->values[] = $value;
    }

    public function __toString(): string
    {
        return $this->getName() . ': ' . $this->getValue();
    }

    public function isEmpty(): bool
    {
        return empty($this->values);
    }

    public function isNonEmpty(): bool
    {
        return !empty($this->values);
    }

    public function append(int|float|string|array|DateTime|Stringable ...$values): static
    {
        foreach ($values as $value) {
            $this->addValue($value);
        }

        return $this;
    }

    public function merge(HttpHeader ...$headers): static
    {
        foreach ($headers as $header) {
            $this->append(...$header->values);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getCorrespondences(): array
    {
        return $this->correspondences;
    }

    /**
     * @param HttpHeader[] $correspondences
     */
    public function setCorrespondences(HttpHeader ...$correspondences): void
    {
        $this->correspondences = $correspondences;
    }

    public function setNamedCorrespondence(string $name, ?HttpHeader $header): void
    {
        $this->correspondences[$name] = $header;
    }

    public function getNamedCorrespondence(string $name, HttpHeader $default = null): ?HttpHeader
    {
        return $this->correspondences[$name] ?? $default;
    }
}