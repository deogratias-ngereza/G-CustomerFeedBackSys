<?php
namespace Web\OS\Controllers;

use Web\OS\Controllers\BaseController;

use App\Models\OS\OS;
use App\Models\OS\OSAccount;

class AuthController extends BaseController{

	public function __construct() {
		parent::__construct();
    }

 
    /*login GET */
	public function get_login(){
		$user = $this->session_get('USER');
		if($user != null) header('location: /'); 
		echo $this->render("app/login.php",[]);
	}

 

	public function post_login(){
		$account_id = $_POST["account_id"];//account no here
		$password = $_POST["password"]; 
		$account = OSAccount::where("acc_no",$account_id)->where("password",$password)->first(); 
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