<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $container->extension(
        namespace: 'doctrine',
        config: [
            'dbal' => [
                'override_url' => true,
                'url' => '%env(resolve:DATABASE_URL)%',
            ],
            'orm' => [
                'auto_generate_proxy_classes' => true, // TODO: Se andiamo serverless guardarci!
                'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
                'auto_mapping' => true,
                'dql' => [
                    'string_functions' => [
                        'JSON_EXTRACT' => 'Scienta\DoctrineJsonFunctions\Query\AST\Functions\Mysql\JsonExtract',
                        'JSON_SEARCH' => 'Scienta\DoctrineJsonFunctions\Query\AST\Functions\Mysql\JsonSearch'
                    ]
                ]
            ],
        ],
    );
};