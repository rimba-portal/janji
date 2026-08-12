<?php

declare(strict_types=1);

namespace Rimba\Agreement;

use Rimba\Base\Services\BitesServiceProvider;

class AgreementServiceProvider extends BitesServiceProvider
{
    protected function bootPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        //
    }

    protected function registerPackage(): void
    {
        //
    }
}
