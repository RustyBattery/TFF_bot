<?php

namespace App\Models\Telegram;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserState extends Model
{
    protected $table = 'tg_user_states';
    protected $fillable = [
        'user_id', 'state'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
