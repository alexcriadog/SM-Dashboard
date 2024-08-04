<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FollowerStat extends Model
{
    use HasFactory;

    protected $table = 'follower_stats';

    protected $fillable = [
        'follower_id',
        'date_followed',
        'likes',
        'comments',
        'posts',
        'engagement_rate',
    ];

    protected $dates = ['date_followed', 'created_at', 'updated_at'];

    /**
     * Scope a query to only include stats between specific dates.
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

        return $query->whereBetween('date_followed', [$startDate, $endDate]);
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
