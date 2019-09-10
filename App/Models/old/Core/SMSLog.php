<?php
namespace App\Models\Core;

use \Illuminate\Database\Eloquent\Model as El_Model;

class SMSLog extends El_Model{
	protected $table = "logs_sms";
    protected $connection = 'default'; 
    public $timestamps = false;
    protected $fillable = [ 
        "sys_ref","app_ref","api_ref","account_no","json_receivers","tag","sms_text_length","sender_name",
        "sms_counts","sms","created_date","created_at","updated_at","completed_at","approximate_time_in_sec",
        "status","trial_counts","last_trial_at","pid",
        "response_type","response_info","error_info",
        "batch_id","batch_no"

    ];
    /*return db-fields structure*/ 
    public function tbl_fields(){
    	return $this->fillable;
    } 

}
?>