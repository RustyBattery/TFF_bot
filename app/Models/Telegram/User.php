<?php

namespace App\Models\Telegram;

use App\Models\Child;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = 'tg_users';
    protected $fillable = [
        'username', 'chat_id'
    ];

    public function state(): HasOne
    {
        return $this->hasOne(UserState::class);
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class, 'tg_user_children', 'user_id', 'child_id');
    }
}
