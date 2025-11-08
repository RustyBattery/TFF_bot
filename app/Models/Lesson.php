<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'area_id', 'start_time', 'end_time', 'day'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public const DAY_ORDER = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function getDayName()
    {
        return [
            'Mo' => 'Понедельник',
            'Tu' => 'Вторник',
            'We' => 'Среда',
            'Th' => 'Четверг',
            'Fr' => 'Пятница',
            'Sa' => 'Суббота',
            'Su' => 'Воскресенье',
        ][$this->day];
    }

    public function getTimeRangeAttribute()
    {
        $start = $this->start_time->format('H:i');
        if (!$this->end_time) {
            return $start;
        }
        return $start . '-' . $this->end_time->format('H:i');
    }

    public function scopeOrdered($query)
    {
        return $query->orderByRaw("FIELD(day, '" . implode("','", self::DAY_ORDER) . "')")
            ->orderBy('start_time');
    }
}
