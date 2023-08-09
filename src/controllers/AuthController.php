<?php 
namespace Kadex\controllers;
use Kadex\app\User;
use Kadex\app\Auth;
use Kadex\app\OTP;
use Kadex\app\Country;
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
		if(Auth::user())  redirect('/');
		$countries = new Country();
		$countries = $countries->all();
		return view('signup',['countries' => $countries]);
	}
	static function register()
	{
		$user = new User;
		$user->data = (object)$_POST;
		$user->save();
		Auth::login($user);	
		return successResponse("Signup successfully","Success",['phone' => $_POST['phone']]);
	}
	static function getOtp(){
		$phone = $_POST['phone'];
		$otp = new OTP();
		$otp->phone_number = $phone;
		$otp->sendOTP();
		return successResponse("Otp sent successfully","Success",['phone' => $phone]);
	}

	static function checkOtp(){
		$input_otp = $_POST['otp'];
		$phone= $_POST['phone'];
		$otp = new OTP();
		if(! $otp->checkOTP($input_otp)){
			return  errorResponse('Incorrect otp');
		}
		$user = new User();
		$user->getByPhone($phone);
		$userExist = $user->data ? true : false;
		Auth::login($user);
		$message =  $userExist ? "Login successfully" : "Phone verified succfessfully";
		return successResponse($message,"Success",['userExist' => $userExist,'phone' =>$phone]);
	}
}