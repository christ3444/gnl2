<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Level extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =  [
        'label', 'number', 'generation_one_bonus_amount', 'generation_two_bonus_amount', 
        'generation_three_bonus_amount'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'level_crossings')->withTimestamps();
    }

    /**
     * Get the a column.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y à H:i:s');
    }

    /**
     * Get the a column.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y à H:i:s');
    }
}
