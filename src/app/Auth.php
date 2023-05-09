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
		if(!$user->data->password === md5($request['password'])){
			 return errorResponse('Incorrect password');
		}
		$_SESSION['user_id'] = base64_encode($user->data->id) ;
		$_SESSION['user'] =  $user->data;
		return successResponse('success');
		 
	}
	static function logout()
	{
		unset($_SESSION['user_id'], $_SESSION['user'] ); 
	}
	static function user ():?Object
	{ 
		return $_SESSION['user'] ?? null;
	}
}