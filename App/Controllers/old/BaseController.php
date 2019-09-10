<?php
namespace Web\OS\Controllers;

use App\Models\Core\Database;

class BaseController{

    private $database;

	public function __construct() {
        //Initialize Illuminate Database Connection
        $this->database = new Database("grand_queue_manager");
    }

    public function render($view,$data){
    	$loader = new \Twig\Loader\FilesystemLoader('./../Templates');
		$twig = new \Twig\Environment($loader, [
		    //'cache' => './../Templates/cache',
		]);
    	return $twig->render($view,$data);
    }

    public function status($code){
    	header('HTTP/1.1 '.$code.' Not Found');
	    echo "<span style='margin-top:30px;'/><p style='font-size:3em;color:gray;'>".$code." - Status.</p>";
    }

    public function session_get($key){
        if(isset($_SESSION[$key])) return $_SESSION[$key];
        return null;
    }
    public function session_set($key,$value){
        $_SESSION[$key] = $value;
    }
    public function session_remove($key){
        if(isset($_SESSION[$key])) unset($_SESSION[$key]);
    }
    public function session_destroy(){
        session_destroy ();
    }



}


?>