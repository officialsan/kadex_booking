<?php 
use Kadex\app\User;
use Kadex\app\Auth;

function login()
{
    $user = new User;

	if(!$user->getByemail($_POST['email'])){
	    return  errorResponse('User not found');
	     
	}
	if(!Auth::login($user , $_POST)){
	    return errorResponse('Incorrect password');
	}
	return successResponse("Login successfully");
}

echo login();