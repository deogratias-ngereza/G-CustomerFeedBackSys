<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Account extends El_Model{
	protected $table = "accounts";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "username","account_no","is_company","password","created_at","suspended","deleted","api_key","fcm_key","fcm_updated_at","address","phone","email",
    ]; 

    protected $hidden = [ 
        "deleted","fcm_key","fcm_updated_at","password"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){ 
    	return $this->fillable;
    }
    

}



?>