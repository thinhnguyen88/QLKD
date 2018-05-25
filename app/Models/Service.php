<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
