<?php
namespace App\Models\Core;

use \Illuminate\Database\Eloquent\Model as El_Model;


class AccountSms extends El_Model{
	protected $table = "acc_sms";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "customer_code","acc_no","provider","status","api_url","api_phone_no","api_sender_name","api_account_id","api_key","api_token","api_secrete_password","api_channel","api_sms_source"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    } 
    

    //return default gmtech default email sender
    public static function default_sms(){
    	return [
    		"customer_code" => "GMTECT01",
    		"acc_no"=>"0001",
    		"provider"=>"GMAIL",
    		"status"=>"ACTIVE",
    		"sender_email"=>"grand123grand1@gmail.com",
    		"sender_password"=>"Dangerboy@123",
    		"host"=>"smtp.gmail.com",
    		"port"=>587,
    		"from"=>"grand123grand1@gmail.com"
    	];
    }

    
   


}



?>