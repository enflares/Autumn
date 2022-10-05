<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System\Interfaces;

interface PluginInterface
{
    public function activate(ApplicationInterface $application, array $config = []): void;

    public function terminate(): void;
}