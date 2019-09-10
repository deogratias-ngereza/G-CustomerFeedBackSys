<?php
namespace App\Controllers\Customers;

use App\Controllers\BaseController;

use App\Models\AppComment;
use App\Models\Account;
use App\Models\App;

class ApiController extends BaseController{

	public function __construct() {
		parent::__construct();
		//$this->session = new Session();
    }

 
	public function comment($customer_code,$app_id,$ref_code){
		//TODO::validate the app-id
		//TODO::check if all comment Obj are all set fine
		
		//phone : "+255",email:"grand123grand1@gmail.com",username:"Grand",
			//comment:"Awesome service",stars_count:0,share : 1,comment_cat_id:-1

		//$customer_code = n

		$app = App::where('app_id',$app_id)->first();
		$account = Account::where('account_no',$customer_code)->first();
		if($app == null || $account == null){
			echo json_encode(["account"=>$account,"app"=>$app,"status"=>"ERROR","msg"=>"Invalid Application Details"]);
		}else{
			$commentObj = json_decode($_POST["comment"],true); 
			$comment = new AppComment();
			$comment->comment_cat_id = $commentObj['comment_cat_id'];
			$comment->account_id = $account->id;
			$comment->app_id = $app->id;
			$comment->created_date = date('Y-m-d');
			$comment->created_at = date('Y-m-d H:i:s');
			$comment->created_time = date('H:i:s');
			$comment->star_value = $commentObj['stars_count'];
			$comment->share = $commentObj['share'];
			$comment->phone = $commentObj['phone'];
			$comment->email = $commentObj['email'];
			$comment->username = $commentObj['username'];
			$comment->comment = $commentObj['comment'];
			$comment->ref_code = $ref_code;

			$comment->save();

			//echo $this->render('app/feedback_form.html',[]);
			$commentObj = json_decode($_POST["comment"],true);
			echo json_encode(["status"=>"OK","msg"=>"OK"]); 
		}

		
	}



}


?>