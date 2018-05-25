<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;
}