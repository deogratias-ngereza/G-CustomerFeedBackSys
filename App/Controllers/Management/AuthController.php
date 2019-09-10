<?php
namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\Account;


class AuthController extends BaseController{

	public function __construct() {
		parent::__construct();
    }

 
    /*login GET */
	public function xxxget_login(){
		$user = $this->session_get('USER');
		if($user != null) header('location: /'); 
		//echo $this->render("app/login.php",[]);
	}

	/*login GET */
	public function login(){
		$user = $this->session_get('USER');
		if($user != null) header('location: /administration'); 
 		//show login form
 		echo $this->render('app/admin_login.html',[
			//"USER" => json_encode($user), 
			//"ACCOUNTS_LIST" => json_encode($accounts_list)
		]);  
 	}

 

	public function post_login(){
		$account_id = $_POST["account_id"];//account no here
		$password = $_POST["password"]; 
		$account = Account::where("account_no",$account_id)->where("password",$password)->first(); 
		if($account == null){
			echo "Invalid credentials";
		}else{
			$this->session_set("USER",$account) ;
			header('location: /'); 
			//var_dump(Session::get());
		}
	}


	public function logout(){
		$this->session_destroy();
		header('location: /'); 
	}

	



}


?>