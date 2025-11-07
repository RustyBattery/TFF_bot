<?php

namespace App\Models;

use App\Models\Telegram\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Child extends Model
{
    protected $table = 'children';
    protected $fillable = [
        'name', 'birthdate', 'area_id'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tg_user_children', 'child_id', 'user_id');
    }
}
