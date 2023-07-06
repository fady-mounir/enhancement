<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = "states";
    protected $fillable = [
        'name',
        'is_active'
    ];

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }

}
