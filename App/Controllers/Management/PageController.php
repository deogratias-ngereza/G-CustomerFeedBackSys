<?php
namespace App\Controllers\Management;

use App\Controllers\BaseController;

use App\Models\Account;
use App\Models\App;
use App\Models\AppComment;

class PageController extends BaseController{

	public function __construct() {
		parent::__construct();
		//$this->session = new Session();
    }

 	public function login(){
 		echo $this->render('app/admin_login.html',[
			//"USER" => json_encode($user),
			//"ACCOUNTS_LIST" => json_encode($accounts_list)
		]);  
 	}


	public function home(){

		$user = $this->session_get('USER');
		$apps = App::where('account_id',$user->id)->get();

		echo $this->render('app/dashboard.html',[
			"USER" => json_encode($user),
			"APP_LIST" => json_encode($apps)
		]);


		/*$account_code = isset($_GET["acc_id"]) ? $_GET["acc_id"] : null;
		$app_id = isset($_GET["app_id"]) ? $_GET["app_id"] : null;
		$ref_code = isset($_GET["ref_code"]) ? $_GET["ref_code"] : 'gmtech';

		if($account_code == null || $app_id == null){
			//echo "INVALID ACCOUNT INFO.";
		}
		echo $this->render('app/feedback_form.html',[
			"ACCOUNT_ID" => $account_code,
			"APP_ID" => $app_id, 
			"REF_CODE" => $ref_code, 
		]);*/

	}

	public function view_app($app_id){

		$user = $this->session_get('USER');
		$apps = App::where('account_id',$user->id)->get();

		$app_info = App::where('app_id',$app_id)->first();
		$comments = [];
		$comments = AppComment::where('deleted',0)
					->where('app_id',$app_info->id)
					->take(200)->get();


		echo $this->render('app/view_app.html',[
			"USER" => json_encode($user),
			"APP_LIST" => json_encode($apps),
			
			"BASE_URL" => $this->app_config('base_url'),
			"APP_INFO" => $app_info,
			"COMMENTS" => $comments,

		]);

	}


}


?>