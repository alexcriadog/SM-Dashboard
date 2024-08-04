<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';

    protected $fillable = [
        'id',
        'name',
        'age',
        'gender',
        'country',
        'email',
        'phone',
        'followers_count',
    ];

    /**
     * Define a relationship with the FollowerStat model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followerStats(): HasMany
    {
        return $this->hasMany(FollowerStat::class);
    }

    /**
     * Define a relationship with the Interaction model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }

    /**
     * Scope a query to only include followers whose stats are between specific dates.
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

        // Join with followerStats and filter by date_followed
        return $query->whereHas('followerStats', function (Builder $q) use ($startDate, $endDate) {
            $q->whereBetween('date_followed', [$startDate, $endDate]);
        });
    }
}
