<?php

declare(strict_types=1);

namespace Rimba\Agreement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'uuid',
    'agreement_type_id',
    'title',
    'description',
    'start_date',
    'end_date',
    'status',
    'party_a_type',
    'party_a_id',
    'party_b_type',
    'party_b_id',
    'attributes',
])]
#[Table(name: 'agreements')]
class Agreement extends Model
{
    /**
     * Get the attributes that should be cast.
     * Ensures dates and settings arrays are hydrated properly by the framework.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'agreement_type_id' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'attributes' => 'array',
        ];
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(AgreementType::class, 'agreement_type_id');
    }

    public function partyA(): MorphTo
    {
        return $this->morphTo();
    }

    public function partyB(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopes(): HasMany
    {
        return $this->hasMany(AgreementScope::class);
    }

    /**
     * Framework Validation Guard Hook
     * Prevents saving if the assigned targets violate the metadata engine rules.
     */
    protected static function booted()
    {
        static::saving(function (Agreement $agreement): void {
            $rules = $agreement->type;
            if (! $rules) {
                return;
            }

            if ($agreement->party_a_type !== $rules->party_a_type) {
                throw new \InvalidArgumentException("Party A must be an instance of {$rules->party_a_type}");
            }

            if ($agreement->party_b_type !== $rules->party_b_type) {
                throw new \InvalidArgumentException("Party B must be an instance of {$rules->party_b_type}");
            }
        });
    }
}
