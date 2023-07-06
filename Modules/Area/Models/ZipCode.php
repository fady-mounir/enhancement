<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZipCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = 'zip_codes';
    protected $fillable = [
        'name',
        'area_id',
        'is_active'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
