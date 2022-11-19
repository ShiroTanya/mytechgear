<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialCustomer extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
       'provider_user_id', 'provider', 'user','provider_user_email'
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_social_customers';

    public function customer()
    {
    	return $this->belongsTo('App\Customer', 'user');
    }
}
