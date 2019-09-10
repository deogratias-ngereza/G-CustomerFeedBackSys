<?php
namespace App\Models\OS;

use \Illuminate\Database\Eloquent\Model as El_Model;

  
class OSAccount extends El_Model{
	protected $table = "acc_os";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "customer_code","acc_no","password","nickname","role","active"
    ];
 
    /*return db-fields structure*/ 
    public function tbl_fields(){
    	return $this->fillable;
    } 

    


    
   


}



?>