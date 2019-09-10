<?php
namespace App\Models\OS;

use \Illuminate\Database\Eloquent\Model as El_Model;

  
class OS extends El_Model{
	protected $table = "os";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "name","app_id","rest_api_key","user_auth_key","active","url"
    ];
 
    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    } 
    

    public function accounts(){
        return $this->hasMany("App\Models\OS\OSAccount","customer_code","name");
    }
     public function categories(){
        return $this->hasMany("App\Models\OS\OSCategory","customer_code","name"); 
    }


    
   


}



?>