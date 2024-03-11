<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'country', 'level_label', 'transaction_password', 'balance', 
        'user_id', 'level_number', 'number_of_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set the user's transaction password.
     *
     * @param  string  $value
     * @return void
     */
    public function setTransactionPasswordAttribute($value)
    {
        $this->attributes['transaction_password'] = Hash::make($value);
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
