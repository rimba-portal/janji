<?php

declare(strict_types=1);

namespace Rimba\Agreement\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Agreement\Models\Agreement;
use Rimba\Agreement\Models\AgreementScope;

trait HasAgreements
{
    /**
     * Agreements where this model is Party A.
     */
    public function agreementsAsPartyA(): MorphMany
    {
        return $this->morphMany(
            Agreement::class,
            'partyA',
            'party_a_type',
            'party_a_id',
        );
    }

    /**
     * Agreements where this model is Party B.
     */
    public function agreementsAsPartyB(): MorphMany
    {
        return $this->morphMany(
            Agreement::class,
            'partyB',
            'party_b_type',
            'party_b_id',
        );
    }

    /**
     * Agreement scopes referencing this model.
     */
    public function agreementScopes(): MorphMany
    {
        return $this->morphMany(
            AgreementScope::class,
            'scopeable',
        );
    }

    /**
     * Query all agreements involving this model.
     *
     * The model may appear as:
     *
     * - Party A
     * - Party B
     * - Scope
     *
     * @return Builder<Agreement>
     */
    public function agreementsQuery(): Builder
    {
        $id = $this->getKey();
        $type = $this->getMorphClass();

        return Agreement::query()
            ->where(function (Builder $query) use ($id, $type): void {
                $query
                    ->where(function (Builder $query) use ($id, $type): void {
                        $query
                            ->where('party_a_type', $type)
                            ->where('party_a_id', $id);
                    })
                    ->orWhere(function (Builder $query) use ($id, $type): void {
                        $query
                            ->where('party_b_type', $type)
                            ->where('party_b_id', $id);
                    })
                    ->orWhereHas(
                        'scopes',
                        function (Builder $query) use ($id, $type): void {
                            $query
                                ->where('scopeable_type', $type)
                                ->where('scopeable_id', $id);
                        },
                    );
            })
            ->distinct();
    }
}
