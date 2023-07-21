<?php 
namespace Kadex\app;

use PDO;
use Kadex\app\Database;
use Kadex\app\User;

class Auth  
{
	public $session = null;
	public $user;
	
	public function isAuthenticated():bool
	{
		return $this->session !== null;
	}

	static function login(User $user, $request)
	{

		if(!isset($request['password'])) return false;
		// dd(md5($request['password']));
		if( $user->data->password != md5($request['password']) ){
			 return false;
		}
		$_SESSION['user_id'] = base64_encode($user->data->id) ;
		$_SESSION['user'] =  $user->data;
		return true;
		 
	}
	static function logout()
	{
		unset($_SESSION['user_id'], $_SESSION['user'] ); 
	}
	static function user ():?Object
	{ 
		if(!isset($_SESSION['user_id'])) return null;
		return (new User())->getId(base64_decode($_SESSION['user_id']));
	}
	static function getUserId()
	{
		return $_SESSION['user_id'];
	}
}