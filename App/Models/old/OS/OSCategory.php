<?php
namespace App\Models\OS;

use \Illuminate\Database\Eloquent\Model as El_Model;

  
class OSCategory extends El_Model{
	protected $table = "os_categories";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "customer_code","name","deleted"
    ];
 
    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    } 
    


    
   


}



?>