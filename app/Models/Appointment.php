<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointment';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function company()
    {
        return $this->hasOne('App\Models\Company' , 'id' , 'company_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Access\User\User' , 'id' , 'user_id');
    }

    public function approver()
    {
        return $this->hasOne('App\Models\Access\User\User' , 'id' , 'approver_uid');
    }
}