<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model as El_Model;


class App extends El_Model{
	protected $table = "apps";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "account_id","app_id","name","email","phone","address","deleted","suspended","visible","img_url","image_name","img_src",
    ];

    protected $hidden = [ 
        "deleted"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>