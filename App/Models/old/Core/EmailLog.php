<?php
namespace App\Models\Core;

use \Illuminate\Database\Eloquent\Model as El_Model;

class EmailLog extends El_Model{
	protected $table = "logs_email";
    protected $connection = 'default'; 
    public $timestamps = false;
    protected $fillable = [ 
        "sys_ref","app_ref","api_ref","account_no","json_receivers","json_cc_list","json_bcc_list","header",
        "body","is_html","created_date","created_at","updated_at","completed_at","approximate_time_in_sec",
        "status","trial_counts","last_trial_at","pid",
        "response_type","response_info","error_info"

    ];
    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    } 

}
?>