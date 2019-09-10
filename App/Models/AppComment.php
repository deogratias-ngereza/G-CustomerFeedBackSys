<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model as El_Model;


class AppComment extends El_Model{
	protected $table = "apps_comments";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "comment_cat_id","account_id","app_id","created_date","created_at","created_time","star_value","phone","email","username","comment","ref_code","deleted","deleted_at","share"
    ];
    protected $hidden = [ 
        "deleted","deleted_at"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>