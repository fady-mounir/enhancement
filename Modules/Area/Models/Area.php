<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = "areas";
    protected $fillable = [
        'state_id',
        'name',
        'is_active'
    ];

    public function zipCodes(): HasMany
    {
        return $this->hasMany(ZipCode::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

}
