<?php
namespace Luquba\Controller;

class InfoController extends BaseController {

	public function index(){
		$info=M('info');
		$count= $info->count();
		$Page = new \Think\Page($count,10);
		$show = $Page->show();
		$result = $info->field('id,name,version,tel,createtime')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('info',$result);
		$this->display();
	}

	public function addOne(){
          if(session('authuser')){
             
             return false;

          }
          $data['name']=I('post.name');
          $data['version']=I('post.version');
          $data['update_info']=I('update');
          $data['tel']=I('post.tel');
          $data['siteurl']=I('post.siteurl');
          $data['intro']=I('post.content');

          if($data['name']==''||$data['version']==''||$data['tel']==''||$data['intro']==''||$data['siteurl']==''||$data['update_info']==''){
          	 $this->error('非法操作',U('Info/add',1));

          }else{
          	 $info=M('info');
          	 $data['createtime']=time();
          	 if($info->create()){

          	 	$result=$info->add($data);

          	 	if($result){
          	 		$this->success('添加成功',U('Info/add'),1);

          	 	}else{
          	 		$this->error('非法操作',U('Info/add',1));
          	 	}

          	 }
          }

	    
	}

	public function add(){

		$this->display();


	}

   public function feedback(){
       
   	   $info=M('feedback');
   	   $count= $info->count();
   	   $Page = new \Think\Page($count,15);
   	   $show = $Page->show();
   	   $result = $info->field('id,uid,content,createtime')->limit($Page->firstRow.','.$Page->listRows)->select();
   	   $this->assign('page',$show);
   	   $this->assign('info',$result);
   	   $this->display();
   }

	
  public function helpshow(){
    
      $info=M('help');
      $count= $info->count();
      $Page = new \Think\Page($count,15);
      $show = $Page->show();
      $result = $info->field('id,question,answer,createtime,lasttime')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('page',$show);
      $this->assign('info',$result);
      $this->display();
       

  }


  public function addhelp(){

    $this->display();
  }

  public function addanswer(){
    
      if(session('authuser')){
            
            return false;

         }
      $data['question']=I('post.qst');
      $data['answer']=I('post.asw');
      if($data['question']==''||$data['answer']==''){
          $this->error('所填内容不能存在空',U('Info/addhelp'),1);
      }else{
        $data['createtime']=time();
        $data['lasttime']=time();
        $m=M('help');
        $result=$m->add($data);
        if($result){
           $this->success('添加成功',U('Info/addhelp'),1);
        }else{
           $this->error('添加失败',U('Info/addhelp'),1);

        }

       
      }
  }

public function updatehelp(){


  $data['question']=I('post.qst');
  $data['answer']=I('post.asw');
  $id=I('post.id');
  if($data['question']==''||$data['answer']==''){
      $this->error('所填内容不能存在空',U('Info/addhelp'),1);
  }else{
   
    $data['lasttime']=time();
    $m=M('help');
    // var_dump($m);
    if($m->create()){
       $result=$m->where('id='.$id)->save($data);
       if($result){
          $this->success('更新成功',U('Info/helpshow'),1);
       }else{
          $this->error('更新失败',U('Info/helpshow'),1);

       }

   }else{
         $this->error('非法操作',U('Info/helpshow'),1);
    }
  }


}


public function update(){

  $id=I('get.id');
  if(!empty($id)){
    $m=M('help');
    $result=$m->field('id,question,answer')->where('id='.$id)->find();
    if ($result) {
      $this->assign('info',$result);
      $this->display();
    }else{
      $this->error('非法操作',U('Info/helpshow'),1);
    }

  }else{
     $this->error('非法操作',U('Info/helpshow'),1);
  }


}


}
