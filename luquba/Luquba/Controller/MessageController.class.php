<?php
namespace Luquba\Controller;
 class MessageController extends BaseController{

 	public function index(){

 		$message=M('sendword');
 		$count= $message->count();
 		$Page = new \Think\Page($count,10);
 		$show = $Page->show();
 		$result = $message->limit($Page->firstRow.','.$Page->listRows)->select();
 		$this->assign('page',$show);
 		$this->assign('sendword',$result);
 		$this->display();
 	}

 	public function deleteMessage(){

 		if(session('authuser')){
 		   
 		   return false;

 		}
 		

 		$id=I('get.id');
 		if(empty($id)){
 			$data="208";//非法操作
 			$this->ajaxReturn($data,'json');

 		}else{

 			$message=M('sendword');
 			$result=$message->where("id=".$id)->delete();
 			if($result!=0){
 				$data="208";
 				$this->ajaxReturn($result,'json');
 			}
 		}
 	}



 }
 ?>