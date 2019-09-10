<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model as El_Model;


class AppCommentCat extends El_Model{
	protected $table = "apps_comments_cat";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "app_id","name","deleted",
    ];

    protected $hidden = [ 
        "deleted",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }

    

}



?>