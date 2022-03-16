<?php
declare(strict_types=1);

use H2P\Kernel;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

$classToFileName = static fn(string $fqcn): string => (new ReflectionClass($fqcn))->getFileName();

return static function (ContainerConfigurator $configurator) use ($classToFileName): void {
    $services = $configurator->services()
        ->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->load(namespace: 'H2P\\', resource: '../src/*')
        ->exclude(
            [
                '../src/Domain',
                $classToFileName(Kernel::class),
            ]
        );

    $services->load(
        namespace: 'H2P\UI\Public\Controller\\',
        resource: '../src/UI/Public/Controller/'
    )->tag('controller.service_arguments');
};
