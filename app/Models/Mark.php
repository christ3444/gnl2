<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mark extends Model
{
  /**
   * The attributes that are mass assignable.
    *
    * @var array
  */
  protected $fillable =  ['action_id', 'description', 'user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function action()
  {
    return $this->belongsTo(Action::class);
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
