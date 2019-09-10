<?php
namespace Web\OS\Controllers;

use Web\OS\Controllers\BaseController;

use App\Models\OS\OS;
use App\Models\OS\OSCategory;
use App\Models\OS\OSPlayer;
use App\Models\OS\OSAccount;
use App\Models\OS\OSAccountHasCategory;


class APIController extends BaseController{

	public function __construct() {
		parent::__construct();
    }


    /*CATEOGRY*/ 
    public function addCategory(){

    	$customer_code = $_POST["customer_code"];
    	$cat_name = $_POST["cat_name"];

    	$cat = new OSCategory;
    	$cat->customer_code = $customer_code;
    	$cat->name = $cat_name;
    	$cat->save();

    	$newCat = OSCategory::where("customer_code",$customer_code)->where("name",$cat_name)->first();
    	if($newCat == null){
    		echo json_encode(["status"=>"ERROR","msg"=>"CATEGORY-DIDNOT ADD","category"=>$newCat]); 
    	}else{
    		echo json_encode(["status"=>"OK","msg"=>"CATEGORY-ADDED","category"=>$newCat]); 
    	}

		
	}

    //update cat
    public function updateCategory(){
		$updates = json_decode($_POST["updates"],true); 
		$cat_id = $_POST["cat_id"];
		$res = OSCategory::where("id",$cat_id)->update($updates);
		echo json_encode(["status"=>"OK","msg"=>"CAT-UPDATED","res"=>$res]); 
	}
	/*delete cat*/
	public function deleteCategory(){
		OSCategory::where("id",$_POST["cat_id"])->delete();
		OSAccountHasCategory::where("cat_id",$_POST["cat_id"])->delete();
		echo json_encode(["status"=>"OK","msg"=>"CATEGORY-DELETED"]); 
	}






 
    /*login GET */
	public function home(){
		header('Content-Type: application/json');
		echo json_encode(["app" => "OS-API"],true);
	}


	/*get all companies*/
	public function getCompanies(){
		$companies = OS::all();
		echo json_encode(["status"=>"OK","msg"=>"COMPANIES","list" => $companies]); 
	}
	/*
		update the account details
	*/
	public function updateCompany(){
		$updates = json_decode($_POST["updates"],true); 
		$company_id = $_POST["company_id"];
		$res = OS::where("id",$company_id)->update($updates);
		echo json_encode(["status"=>"OK","msg"=>"COMPANY-UPDATED","res"=>$res]); 
	}
	/*
		add the a company details
	*/
	public function addCompany(){
		
		$oldAcc = OS::where('name',$_POST["name"])->first();
		if($oldAcc != null){
			echo json_encode(["status"=>"ERROR","msg"=>"ACCOUNT EXISTS"]);
			exit();
		}

		$acc = new OS;
		$acc->name = $_POST["name"];
		$acc->app_id = $_POST["app_id"];
		$acc->rest_api_key = $_POST["rest_api_key"];
		$acc->user_auth_key = $_POST["user_auth_key"];
		$acc->active = $_POST["active"];
		$acc->url = $_POST["url"];
		$acc->save();

		//load the account details
		$newAcc = OS::where('name',$_POST["name"])->first();

		echo json_encode(["status"=>"OK","msg"=>"COMPANY-CREATED","company"=>$newAcc]); 
	}
	/*delete company*/
	public function deleteCompany(){
		$oldAcc = OS::where('id',$_POST["company_id"])->first();
		$oldAcc->delete();
		echo json_encode(["status"=>"OK","msg"=>"COMPANY-DELETED"]); 
	}







	/*
		add the account details
	*/
	public function addAccount(){
		
		$oldAcc = OSAccount::where('acc_no',$_POST["acc_no"])->first();
		if($oldAcc != null){
			echo json_encode(["status"=>"ERROR","msg"=>"ACCOUNT EXISTS"]);
			exit();
		}

		$acc = new OSAccount;
		$acc->customer_code = $_POST["customer_code"];
		$acc->acc_no = $_POST["acc_no"];
		$acc->nickname = $_POST["nickname"];
		$acc->password = $_POST["password"];
		$acc->active = $_POST["active"];
		$acc->role = $_POST["role"];
		$acc->save();

		//load the account details
		$newAcc = OSAccount::where('acc_no',$_POST["acc_no"])->first();

		echo json_encode(["status"=>"OK","msg"=>"ACCOUNT-UPDATED","account"=>$newAcc]); 

	}



	/*get accounts list*/
	public function getAccounts($customer_code){
		$accounts = OSAccount::where('customer_code',$customer_code)->get();
		echo json_encode(["status"=>"OK","msg"=>"ACCOUNT-DELETED","list" => $accounts]); 
	}

	/*delete accounts*/
	public function deleteAccount(){
		$oldAcc = OSAccount::where('id',$_POST["account_id"])->delete();
		
		//delete all the players and cat related
		OSPlayer::where("account_id",$_POST["account_id"])->delete();
		OSAccountHasCategory::where("acc_id",$_POST["account_id"])->delete();

		echo json_encode(["status"=>"OK","msg"=>"ACCOUNT-DELETED"]); 
	}


	/*
		update the account details
	*/
	public function updateAccount(){
		$updates = json_decode($_POST["updates"],true); 
		$account_id = $_POST["account_id"];
		$res = OSAccount::where("id",$account_id)->update($updates);
		echo json_encode(["status"=>"OK","msg"=>"ACCOUNT-UPDATED","res"=>$res]); 
	}





	public function addCategoryToAccount(){
		$account_no = $_POST["account_no"];
		$cat_id = $_POST["cat_id"];
		
		//load the account info
		$account = OSAccount::where("acc_no",$account_no)->first();
		if($account == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID ACCOUNT"]);
			exit();
		}

		$ahc = OSAccountHasCategory::where("acc_id",$account->id)->where("cat_id",$cat_id)->first();

		if($ahc != null){
			echo json_encode(["status"=>"ERROR","msg"=>"CATEGORY ALREADY EXIST"]);
			exit();
		}

		$accHasCat = new OSAccountHasCategory;
		$accHasCat->acc_id = $account->id;
		$accHasCat->cat_id = $cat_id;
		$accHasCat->save();

		$cat = OSAccountHasCategory::where("acc_id",$account->id)->where("cat_id",$cat_id)->with(["account","category"])->first();

		echo json_encode(["status"=>"OK","msg"=>"CATEGORY ADDED TO ACCOUNT","category"=> $cat]);
			exit();
	}



	public function removeCategoryFromAccount(){
		$account_no = $_POST["account_no"];
		$cat_id = $_POST["cat_id"];//selected from the relation list
		//load the account info
		$account = OSAccount::where("acc_no",$account_no)->first();
		if($account == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID ACCOUNT","player"=>null]);
			exit();
		}

		$cat = OSAccountHasCategory::where("id",$cat_id)->first();
		if($cat!= null) $cat->delete();

		echo json_encode(["status"=>"OK","msg"=>"CATEGORY DELETED"]);
			exit();
	}

	public function subscribe_player(){
		$account_no = $_POST["account_no"];
		$player_id = $_POST["player_id"];

		OSPlayer::where("id",$player_id)->update([
			"subscribe" => 1
		]);

		echo json_encode(["status"=>"OK","msg"=>"SUBSCRIBED."]);
			exit();
	}
	public function unsubscribe_player(){
		$account_no = $_POST["account_no"];
		$player_id = $_POST["player_id"];

		OSPlayer::where("id",$player_id)->update([
			"subscribe" => 0
		]);

		echo json_encode(["status"=>"OK","msg"=>"UNSUBSCRIBED."]);
			exit();
	}

	public function add_player(){

		//post
		$account_no = $_POST["account_no"];
		$player_id = $_POST["player_id"];



		//load the account info
		$account = OSAccount::where("acc_no",$account_no)->first();
		if($account == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID ACCOUNT","player"=>null]);
			exit();
		}

		//check if accountid has a given player
		$player = OSPlayer::where("account_id",$account->id)->where("player_id",$player_id)->first();
		if($player != null){
			echo json_encode(["status"=>"OK","msg"=>"PLAYER-EXISTS","player"=>null]);
			exit();
		}

		//load info about the one signal account
		$osCustomer = OS::where("name",$account->customer_code)->first();
		if($osCustomer == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID CUSTOMER-INFO","player"=>null]);
			exit();
		}

		//call one signal for getting player informations
		$APP_ID = $osCustomer->app_id;
	    $PLAYER_ID = $player_id;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players/".$PLAYER_ID."?app_id=".$APP_ID);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: '.$osCustomer->rest_api_key));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
	    $os_response = curl_exec($ch);
	    curl_close($ch);

	    $os_response = json_decode($os_response,true);
	    if(!isset($os_response["id"])){
	    	echo json_encode(["status"=>"ERROR","msg"=>"UNKNOWN-PLAYER","player"=>null]);
			exit();
	    }else{
	    	
	    	//save this player to the db with the account given
	    	$p = new OSPlayer;
	    	$p->account_id = $account->id;
	    	$p->player_id = $os_response["id"];
	    	$p->device_type = $os_response["device_model"];
	    	$p->device_description = "OS: ". $os_response["device_os"]." & IP: ".$os_response["ip"];
	    	$p->subscribe = 1; 
	    	$p->deleted = 0; 
	    	$p->save();
	    	echo json_encode(["player_info"=>$os_response,"status"=>"OK","msg"=>"PLAYER ADDED","player"=>$p]);
			exit();
	    }

		
	}

	//only to given account available to us
	public function send_sms_to_account(){
		$sender_account_no = $_POST["sender_account_no"];
		$account_no = $_POST["account_no"];
		$subject = $_POST["subject"];
		$body = $_POST["body"];
		$img_url = $_POST["img_url"];


		
		//load the account info
		$account = OSAccount::where("acc_no",$sender_account_no)->first();
		if($account == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID ACCOUNT"]);
			exit();
		}
		$receiver_account = OSAccount::where("acc_no",$account_no)->first();
		if($account == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID RECEIVER-ACCOUNT"]);
			exit();
		}
		//load info about the one signal account
		$osCustomer = OS::where("name",$account->customer_code)->first();
		if($osCustomer == null) {
			echo json_encode(["status"=>"ERROR","msg"=>"INVALID CUSTOMER-INFO"]);
			exit();
		}

		//find all devices related to account
		$raw_players = OSPlayer::where("account_id",$receiver_account->id)->where("subscribe",1)->get();
		$preparedPlayers = [];
		for($i= 0; $i < sizeof($raw_players);$i++){
			array_push($preparedPlayers, $raw_players[$i]["player_id"]);
		}

		//check if players are available
		if(sizeof($preparedPlayers) == 0) {
			echo json_encode(["status"=>"OK","msg"=>"No devices available!"]);
			exit();
		}

		//call one signal for getting player informations
		$APP_ID = $osCustomer->app_id;
		$content = array(
        	"en" => $body
        );
	    $fields = array(
	        'app_id' => $APP_ID,
	        //'included_segments' => array('Active Users'),
	        'data' => array("app" => "g-note"),
	        'headings' => [
	        	"en" => $subject
	        ],
	        'include_player_ids' => $preparedPlayers,
	        'large_icon' =>$img_url,
	        'contents' => $content,
	        'url'=> "https://google.com",
	    	'chrome_web_icon'=> "https://cdn4.iconfinder.com/data/icons/iconsimple-logotypes/512/github-512.png",      
	    	'chrome_web_image'=> $img_url

	    );

	    $fields = json_encode($fields);
	
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic '.$osCustomer->rest_api_key));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

	    $os_response = curl_exec($ch);
	    curl_close($ch);

		echo json_encode(["status"=>"OK","msg"=>"MSG-SENT.","os_response"=>$os_response]);
			exit();
	}


	



}


?>