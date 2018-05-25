<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Goals.
 */
class Goals extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'goals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goals'];
}
