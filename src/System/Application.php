<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System;

use Autumn\App;
use Autumn\System\Interfaces\ApplicationInterface;
use Autumn\System\Interfaces\PluginInterface;
use RuntimeException;

class Application extends FilterChain implements ApplicationInterface
{
    public const VERSION = '1.0.0';

    protected array $interfaces = [];
    protected array $plugins = [];

    public function __construct(
        private string $rootPath = DOC_ROOT,
    )
    {
        if (defined('APPLICATION')) {
            throw new RuntimeException('Application is running.');
        }
        define('APPLICATION', static::class);

        App::bind(ApplicationInterface::class, $this);
    }

    protected function onFilter(Request $request, Response $response): void
    {
        foreach ($this->plugins as $plugin => $config) {
            if (is_int($plugin)) {
                $plugin = $config;
                $config = [];
            }

            if($instance = App::instance( App::binding($plugin) ?: $plugin, PluginInterface::class, true)) {
                App::bind($plugin, $instance, true);
            }

            if (is_subclass_of($plugin, PluginInterface::class)) {
                if (!is_array($config)) $config = $this->config($plugin);
                App::factory($plugin)?->activate($this, $config);
            }
        }
    }

    public function filter(Request $request, Response $response, callable $next): Response
    {
        if ($route = $request->getRoute() ?: Route::matches($request)) {
            return $route->process($request, $next);
        }

        return $response;
    }

    public function config(string ...$args): array
    {
        static $g = [];
        if (!isset($g[$path = strtr(implode(DIRECTORY_SEPARATOR, $args), '\\', DIRECTORY_SEPARATOR)])) {
            $g[$path] = [];
            if ($file = realpath($this->map('config', $path . '.env'))) {
                $data = parse_ini_file($file, true);
                if (is_array($data)) $g[$path] = $data;
            }
        }
        return $g[$path];
    }

    public function forClass(string $class): string
    {
        return $this->interfaces[$class] ?? $class;
    }

    public function map(string ...$args): string
    {
        array_unshift($args, $this->root());
        return implode(DIRECTORY_SEPARATOR, $args);
    }

    public function root(): string
    {
        return $this->rootPath;
    }

    public function run(): void
    {
        if (defined('RUN_TIME')) {
            throw new RuntimeException('Application is booted');
        }
        define('RUN_TIME', true);

    }

    public function end(): void
    {
        if (!defined('END_TIME')) {
            define('END_TIME', microtime(true));

            foreach ($this->plugins as $plugin => $config) {
                if (is_int($plugin)) {
                    $plugin = $config;
                }

                if($instance = App::binding($plugin)) {
                    if($instance instanceof PluginInterface) {
                        $instance->terminate();
                    }
                }
            }

            App::terminate();
        }
    }
}