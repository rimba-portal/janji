<?php

declare(strict_types=1);

namespace Rimba\Agreement\Observers;

use Rimba\Agreement\Events\AgreementScopeChanged;
use Rimba\Agreement\Models\AgreementScope;

final class AgreementScopeObserver
{
    public function created(AgreementScope $scope): void
    {
        $this->dispatch($scope);
    }

    public function updated(AgreementScope $scope): void
    {
        $this->dispatch($scope);
    }

    public function deleted(AgreementScope $scope): void
    {
        $this->dispatch($scope);
    }

    private function dispatch(AgreementScope $scope): void
    {
        AgreementScopeChanged::dispatch(
            agreementId: $scope->agreement_id,
            scopeableType: $scope->scopeable_type,
        );
    }
}
