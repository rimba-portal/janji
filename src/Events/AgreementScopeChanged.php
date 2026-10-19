<?php

declare(strict_types=1);

namespace Rimba\Agreement\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final readonly class AgreementScopeChanged
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public int $agreementId,
        public string $scopeableType,
    ) {}
}
