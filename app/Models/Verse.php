<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verse extends Model
{
    /**
     * The verse this devotion is attached to
     *
     * @return BelongsTo
     */
    public function devotion(): BelongsTo
    {
        return $this->belongsTo(Devotion::class);
    }
}
