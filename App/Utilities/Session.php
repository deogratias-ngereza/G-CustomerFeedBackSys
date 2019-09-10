<?php
namespace Web\OS\Utilities;

use Josantonius\Session\Session as JSession;


class Session{
	public function __construct(){
		
	}

	public static function get($key=""){
		if( isset( $_SESSION[$key] ) ) {
	        return $_SESSION[$key];
	    }else {
	        return null; 
	    }
	}


	public static function set($key,$value){
		$_SESSION[$key] = $value;
	}
}




class xxxSession{ 

	protected $Session;

	public function __construct(){
		$this->Session = new JSession;
	}
	public function init($key=""){
		JSession::init(3600000);
	}
	public function get($key=""){
		if($key == "") return JSession::get();
		return JSession::get($key);
	}
	public function set($key,$value){
		JSession::init(3600000);
		JSession::setPrefix('');
		JSession::set($key,$value);
	}
	public function pull($key){
		return JSession::pull($key);
	}
	public function destroy(){
		return JSession::destroy(); 
	}
}


class xSession{ 

	protected $Session;

	public function __construct(){
		$this->Session = new JSession;
	}

	public function get($key=""){
		$session = $this->Session;
		$session->set("DD","DATA");
		if($key == "") return $session->get();
		return $session->get($key);
		//if($key == "") return JSession::get();
		//return JSession::get("".$key);
	}
	public function set($key,$value){
		$session = $this->Session;
		$session::init(3600000);
		$session::setPrefix('');
		$session::set($key,$value);
		//JSession::init(360000); 
		//JSession::setPrefix('');
		//return JSession::set($key,$value);
	}
	public function pull($key){
		return JSession::pull($key);
	}
	public function destroy(){
		return JSession::destroy(); 
	}
}


?>