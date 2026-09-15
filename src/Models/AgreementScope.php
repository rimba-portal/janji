<?php

declare(strict_types=1);

namespace Rimba\Agreement\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'agreement_id',
    'scopeable_type',
    'scopeable_id',
])]
class AgreementScope extends Model
{
    use HasFactory;

    /**
     * Get the parent agreement that owns this scope target.
     */
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }

    /**
     * Get the underlying polymorphic scope target model instance
     * (e.g., JobPosition, Asset, etc.).
     */
    public function scopeable(): MorphTo
    {
        return $this->morphTo();
    }
}
