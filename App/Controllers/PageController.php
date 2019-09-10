<?php
namespace App\Controllers;


class PageController extends BaseController{

	public function __construct() {
		parent::__construct();
		//$this->session = new Session();
    }

 
 	public function users_page(){
 		$user = $this->session_get("USER");
 		$accounts_list = OSAccount::where("customer_code",$user->customer_code)->get();

 		echo $this->render('app/users_management.php',[
			"USER" => json_encode($user),
			"ACCOUNTS_LIST" => json_encode($accounts_list)
		]);  
 	}
 	public function companies_page(){
 		$user = $this->session_get("USER");
 		$os = OS::all();

 		echo $this->render('app/companies.php',[
			"USER" => json_encode($user),
			"COMPANIES_LIST" => json_encode($os)
		]);  
 	}


 	public function credentials_init_page(){
 		$user = $this->session_get("USER");
 		$os = OS::with(["accounts","categories"])->get();

 		echo $this->render('app/credentials_init.php',[
			"USER" => json_encode($user),
			"COMPANIES_LIST" => $os//json_encode($os)
		]);  
 	}


	public function home(){

		$user = $this->session_get("USER");
		$categories = OSCategory::where("customer_code",$user->customer_code)->where("deleted",0)->get();
		$my_categories = OSAccountHasCategory::where("acc_id",$user->id)->with(["account","category"])->get();
		$players = OSPlayer::where("account_id",$user->id)->where("deleted",0)->get();
		$accounts = OSAccount::where("customer_code",$user->customer_code)
					//->where("acc_no","<>",$user->acc_no)
					->where("active",1)
					->get();

					//::TODO:: make sure that the account is active before shooting the management dashboard
		$app_infos = OS::where("name",$user->customer_code)->first();


		//$_SERVER['HTTP_USER_AGENT'];
		//$this->session_destroy();
		
		echo $this->render('app/home.php',[
			"USER" => json_encode($user),
			"CATEGORIES" => $categories,
			"MY_CATEGORIES" =>$my_categories,
			"PLAYERS" => $players,
			"FRIENDS_ACCOUNTS"=>$accounts,
			"APP_INFO" => $app_infos
		]);  
	}



}


?>