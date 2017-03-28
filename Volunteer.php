<?php
namespace App\PiplModules\volunteer\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model 
{

//	use \Dimsav\Translatable\Translatable;
//	
//	public $translatedAttributes = ['name'];
    
	protected $fillable = ['user_id','first_name','last_name','email_id','address','created_at','updated_at'];
	
}