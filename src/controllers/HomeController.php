<?php 
namespace Kadex\controllers;
use Kadex\app\Services;

class HomeController {
	static function index() {
		$services = (new Services())->all();
		return view('home',['services' => $services]);
	}
}