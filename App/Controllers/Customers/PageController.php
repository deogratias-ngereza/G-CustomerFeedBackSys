<?php
namespace App\Controllers\Customers;

use App\Controllers\BaseController;

class PageController extends BaseController{

	public function __construct() {
		parent::__construct();
		//$this->session = new Session();
    }

 
	public function home(){

		$account_code = isset($_GET["acc_id"]) ? $_GET["acc_id"] : null;
		$app_id = isset($_GET["app_id"]) ? $_GET["app_id"] : null;
		$ref_code = isset($_GET["ref_code"]) ? $_GET["ref_code"] : 'gmtech';

		if($account_code == null || $app_id == null){
			//echo "INVALID ACCOUNT INFO.";
		}
		echo $this->render('app/feedback_form.html',[
			"ACCOUNT_ID" => $account_code,
			"APP_ID" => $app_id, 
			"REF_CODE" => $ref_code, 
		]);

	}



}


?>