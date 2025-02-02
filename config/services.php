<?php

declare(strict_types=1);

/**
 * Copyright 2023-present MongoDB, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MongoDB\Bundle\Command\DebugCommand;
use MongoDB\Client;

return static function (ContainerConfigurator $container): void {
    // default configuration for services in *this* file
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->set(DebugCommand::class)
        ->args([
            tagged_locator('mongodb.client'),
        ])
        ->tag('console.command');

    $services
        ->set('mongodb.prototype.client', Client::class)
        ->arg('$uri', abstract_arg('Should be defined by pass'))
        ->arg('$uriOptions', abstract_arg('Should be defined by pass'))
        ->arg('$driverOptions', abstract_arg('Should be defined by pass'))
        ->tag('mongodb.client');
};
