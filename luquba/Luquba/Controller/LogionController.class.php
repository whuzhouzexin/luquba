<?php
namespace Luquba\Controller;
/**
* 
*/
class LogionController extends BaseController
{
	
	public function index(){
		
		$logion=M('logion');
		$count= $logion->count();
		$Page = new \Think\Page($count,10);
		$show = $Page->show();
		$result = $logion->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('logion',$result);
		$this->display();
	}

	public function add(){

		$this->display();

	}

	public function update(){

		$id=I('get.id');
		if(!empty($id)){
		  $m=M('logion');
		  $result=$m->field('id,author,country,content')->where('id='.$id)->find();
		  if ($result) {
		    $this->assign('logion',$result);
		    $this->display();
		  }else{
		    $this->error('非法操作',U('Info/helpshow'),1);
		  }

		}else{
		   $this->error('非法操作',U('Info/helpshow'),1);
		}

		

		

	}

	public function updateOne(){

		if(session('authuser')){
		   
		   return false;

		}
		

		$data['author']=I('post.username');
		$data['country']=I('post.country');

		$data['content']=I('post.content');
		$id=I('post.id');
		if($data['author']==''||$data['country']==''||$id==''||$data['content']==''){
		    $this->error('所填内容不能存在空',U('Logion/index'),1);
		}else{
		 
		  $data['lasttime']=time();
		  $m=M('logion');
		  
		  if($m->create()){
		     $result=$m->where('id='.$id)->save($data);
		     if($result){
		        $this->success('更新成功成功',U('Logion/index'),1);
		     }else{
		        $this->error('更新失败',U('Logion/index'),1);

		     }

		 }else{
		       $this->error('非法操作',U('Logion/index'),1);
		  }
		}

	}

	public function addOne(){
        if(session('authuser')){
            
            return false;

         }
		$data['author']=I('post.username');
		$data['country']=I('post.country');
		$data['content']=I('post.content');
		if($data['author']==''||$data['country']==''||$data['content']==''){
			$this->error('提交内容不能为空',U('Logion/add'),1);
		}else{
			$data['createtime']=time();
			$data['lasttime']=time();
			$logion=M("logion");
			if($logion->create()){
             

				$result=$logion->add($data);
				if($result){
					$this->success('添加成功',U('Logion/add'),1);
				}
			}
		}




	}
}
?>