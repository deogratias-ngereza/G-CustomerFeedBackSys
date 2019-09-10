<?php
namespace App\Models\OS;

use \Illuminate\Database\Eloquent\Model as El_Model;

  
class OSPlayer extends El_Model{
	protected $table = "os_players";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "account_id","player_id","device_type","device_description","subscribe","deleted","created_at"
    ];
 
    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    } 
    


    
   


}



?>