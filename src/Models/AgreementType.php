<?php

declare(strict_types=1);

namespace Rimba\Agreement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'code',
    'name',
    'party_a_type',
    'party_b_type',
    'scopeable_type',
    'scopeable_relation',
    'settings',
])]
#[Table(name: 'agreement_types')]
class AgreementType extends Model
{
    /**
     * Get the attributes that should be cast.
     * Ensures configuration arrays are parsed cleanly by the engine.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'settings' => 'array',
        ];
    }

    /**
     * Get all agreements generated under this validation rule profile.
     */
    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class, 'agreement_type_id');
    }

    /**
     * Multiplicity Check: Verifies if this rule type allows
     * multiple physical targets inside the scope ledger.
     */
    public function allowsMultipleScopes(): bool
    {
        return ($this->scopeable_relation ?? 'one') === 'many';
    }
}
