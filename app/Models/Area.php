<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = [
        'name', 'address'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Child::class, 'area_id', 'id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'area_id', 'id');
    }
}
