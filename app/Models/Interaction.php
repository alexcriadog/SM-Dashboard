<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interaction extends Model
{
    use HasFactory;

    protected $table = 'interactions';

    protected $fillable = [
        'follower_id',
        'type',
        'content',
        'timestamp',
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * Scope a query to only include interactions between specific dates.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateBetween(Builder $query, $startDate, $endDate)
    {
        // Validate and format the dates
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Define a relationship with the Follower model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function follower()
    {
        return $this->belongsTo(Follower::class);
    }
}
