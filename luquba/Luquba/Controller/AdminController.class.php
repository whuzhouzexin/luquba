<?php
namespace Luquba\Controller;
 class AdminController extends BaseController{

 	public function index(){
       if(session('authuser')){
           
        	return false;

        }
 		$admin=M('admin');
 		$count= $admin->count();
 		$Page = new \Think\Page($count,10);
 		$show = $Page->show();
 		$result = $admin->field('id,username,role_name')->limit($Page->firstRow.','.$Page->listRows)->select();
 		$this->assign('page',$show);
 		$this->assign('admin',$result);
 		$this->display();
 	}

 	public function addAdmin(){

        if(session('authuser')){
           
           return false;

        }
        
 		$data['username']=I('post.username');
 		$data['password']=md5(I('post.pass'));
 		$data['role_name']=I('post.role');
 		$data['admin_type']=I('post.type');
 		$data['admin_auth']=md5(I('post.auth'));
 		if($data['username']==''||$data['password']==''||$data['role_name']==''||$data['admin_type']==''||$data['admin_auth']==''){

 			session('lqb_user',null);
 			$this->error('非法操作',U('Login/index'),1);
 			
 		}
 		if($data['role_name']==1){
 			$data['role_name']="超级管理员";

 		}
 		if($data['role_name']==2){
 			$data['role_name']="普通管理员";

 		}
 		if($data['role_name']==3){

 			$data['role_name']="低级管理员";

 		}
 		else{
 			$admin=M('admin');
 			
 			if($admin->create()){
 				$admin->add($data);
 				$this->success('添加成功',U('Admin/addUser'),1);
 			}
 		}
       
    }

 		
    public function addUser(){
         if(session('authuser')){
        	
        	return false;

        }
    	$this->display();
    

 	}

 	public function deleteAdmin(){

         if(session('authuser')){
        	
        	return false;

        }

 		$admin=M("admin");
 		$id=I('get.id');

 		if (empty($id)) {
 			$data='208';//参数为空
 			$this->ajaxReturn($data,'json');

 		}else{

 			$result=$admin->where("id=".$id)->delete();
 			if($result){
 				$data='209';//删除成功
 				$this->ajaxReturn($data,json);
 			}else{
 				$data="300";
 				$this->ajaxReturn($data,'json');
 			}

 		}


 	}

 }
?>