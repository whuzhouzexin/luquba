<?php
namespace Luquba\Controller;
 class ContentController extends BaseController{

 	public function index(){
 		
        // if(session('authuser')){
           
        //    return false;

        // }
 		$this->assign('class2',"active");
 		$this->display();
 	}
 }
?>