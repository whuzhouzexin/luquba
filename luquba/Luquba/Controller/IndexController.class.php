<?php
namespace Luquba\Controller;

class IndexController extends BaseController {

    public function index(){

    	$this->assign('class',"active");
     
    	$this->display();
       
    }

    public function showUser(){

    	$user=M('user');
    	$count= $user->count();
    	$Page = new \Think\Page($count,2);
    	$show = $Page->show();
    	$result = $user->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('page',$show);
    	$this->assign('users',$result);

    	$this->display();
    }


    public function deleteUser(){

         if(session('authuser')){
            
            return false;

         }
         $id=I('get.id');
         $user=M('user');
         $result=$user->where('uid='.$id)->delete();
         if($result){
         	$data="205";
         	$this->ajaxReturn($data,'json');
         }

    }

    public function selectUser(){


        $this->display();

    }

    public function selectUs(){

        $uid=I('post.id');
        $nickname=I('post.nickname');
        $tel=I('post.tel');
        $ip=I('post.uip');
        $user=M('user');
        if(!empty($uid)){

           $data= $user->field('uid,username,lastip,tel')->where("uid=".$uid)->select();

           if($data){

              $this->ajaxReturn($data,'json');

           }else{

                $data="207";//所查内容不存在
                $this->ajaxReturn($data,'json');
           }
         

        }
        if(!empty($nickname)){

            $data= $user->field('uid,username,lastip,tel')->where("username=".$nickname)->select();
            if($data){

               $this->ajaxReturn($data,'json');

            }else{

                 $data="207";//所查内容不存在
                 $this->ajaxReturn($data,'json');
            }


        }
        if(!empty($tel)){

            $data= $user->field('uid,username,lastip,tel')->where("tel=".$tel)->select();
            if($data){

               $this->ajaxReturn($data,'json');

            }else{

                 $data="207";//所查内容不存在
                 $this->ajaxReturn($data,'json');
            }
        }
        if(!empty($ip)){

            $data= $user->field('uid,username,lastip,tel')->where("lastip=".$ip)->select();
           if($data){

              $this->ajaxReturn($data,'json');

           }else{

                $data="207";//所查内容不存在
                $this->ajaxReturn($data,'json');
           }
        }
        else{

             $data='206';//查询条件没数进来
             $this->ajaxReturn($data,'json');

        }

    }


    public function editor(){
           
            $editor=new \Org\Util\Ueditor();
            echo $editor->output();
    }


}