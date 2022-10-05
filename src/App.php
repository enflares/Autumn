<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/4
 */

namespace Autumn;

use Autumn\Http\Exceptions\ConflictException;
use Autumn\System\Interfaces\ApplicationInterface;
use InvalidArgumentException;
use JetBrains\PhpStorm\NoReturn;

class App
{
    private static array $instances = [];

    public static function context(): ?ApplicationInterface
    {
        return self::$instances[ApplicationInterface::class] ?? null;
    }

    public static function bind(string $key, object $value, bool $overwrite = null): object
    {
        if ($value instanceof $key) {
            if (!$overwrite && isset(self::$instances[$key])) {
                throw new ConflictException('The binding "' . $key . '" already exists.');
            }
            return self::$instances[$key] = $value;
        }

        throw new InvalidArgumentException('The value is not an instance of ' . $key);
    }

    public static function binding(string $key): mixed
    {
        return self::$instances[$key] ?? null;
    }

    public static function instance(string|object|null $classOrObject, string $interface = null, bool $ignore = false): ?object
    {
        $result = null;

        if ($interface) {
            if (is_string($classOrObject)) {
                if (is_subclass_of($classOrObject, $interface)) {
                    $result = self::factory($interface);
                }
            } elseif ($classOrObject instanceof $interface) {
                $result = $classOrObject;
            }
        } else {
            if (is_string($classOrObject)) {
                $result = self::factory($classOrObject);
            } else {
                $result = $classOrObject;
            }
        }

        if ($result === null) {
            if (!$ignore) {
                if ($classOrObject) {
                    throw new InvalidArgumentException('The first argument is not an implementation of ' . $interface);
                } else {
                    throw new InvalidArgumentException('The first argument is null.');
                }
            }
        }

        return $result;
    }

    public static function factory(string $class): object
    {
        if ($instance = self::autoWire(self::forClass($class))) {
            self::$instances[$class] = $instance;
        }
        return $instance;
    }

    #[NoReturn]
    public static function terminate(): void
    {
        self::$instances = [];
        exit;
    }

    public static function forClass(string $class): string
    {
        if ($context = self::context()) {
            return $context->forClass($class);
        }
        return $class;
    }

    public static function autoWire(string $class): object
    {
        if (isset(self::$instances[$class])) return self::$instances[$class];
        return new $class;
    }
}