<?php 
namespace Kadex\controllers;
use Kadex\app\User;
use Kadex\app\Auth;
class AuthController {
	static function login()
	{
		$user = new User;
		if(!$user->getByemail($_POST['email'] ?? '')){
		    return  errorResponse('User not found');
		}
		if(!Auth::login($user , $_POST)){
		    return errorResponse('Incorrect password');
		}
		return successResponse("Login successfully");
	}
	static function logout()
	{
		Auth::logout();
		redirect();
	}
	static function signup()
	{
		if(Auth::user())  redirect();
		return view('signup');
	}
	static function register()
	{
		$user = new User;
		$user->data = $_POST;
		$user->save();	
	}
}