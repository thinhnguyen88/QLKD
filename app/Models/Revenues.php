<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Revenues.
 */
class Revenues extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'revenues';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    public function service(){

        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }
}
