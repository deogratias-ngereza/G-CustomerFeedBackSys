<?php
namespace App\Models\OS;

use \Illuminate\Database\Eloquent\Model as El_Model;

  
class OSAccountHasCategory extends El_Model{
	protected $table = "os_acc_has_categories";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "acc_id","cat_id"
    ];
 
    /*return db-fields structure*/ 
    public function tbl_fields(){
    	return $this->fillable;
    } 
    

    public function account(){
    	return $this->belongsTo('App\Models\OS\OSAccount','acc_id');
    }

    public function category(){
    	return $this->belongsTo('App\Models\OS\OSCategory','cat_id');
    }

    
   


}



?>