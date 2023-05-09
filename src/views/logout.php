<?php 
use Kadex\app\User;
use Kadex\app\Auth;

Auth::logout();

echo successResponse("Logout successfully");