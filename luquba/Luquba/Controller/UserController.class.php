<?php
namespace Luquba\Controller;

class UserController extends BaseController {

    public function index(){

    	if(session('authuser')){
    	   
    	   return false;

    	}

    	$this->assign('class1',"active");

    	$this->display();


             

       
    }
}