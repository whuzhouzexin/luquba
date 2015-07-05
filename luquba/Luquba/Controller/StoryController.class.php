<?php
namespace Luquba\Controller;
/**
* 
*/
class StoryController extends BaseController
{
	
	public function index(){

		$story=M('Story');
		$count= $story->count();
		$Page = new \Think\Page($count,10);
		$show = $Page->show();
		$result = $story->field('id,author,origin,title,createtime,url')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('story',$result);
		$this->display();
		
	}

	public function add(){
		
		$this->display();
	}

	public function addOne(){
        
            if(session('authuser')){
               
               return false;

            }

           //获取信息
        	$data['author']=I("post.username");
        	$data['title']=I("post.title");
        	$data['origin']=I("post.from");
        	$data['intro']=I("post.content");

        	if($data['author']==''||$data['title']==''||$data['origin']==''||$data['intro']==''){
        		$this->error('非法操作',U('Story/add'),1);

        	}else{

        			$upload = new \Think\Upload();// 实例化上传类
        		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
        		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        		    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        		    $upload->savePath  =     ''; // 设置附件上传（子）目录
        		    // 上传文件 
        		    $info   =   $upload->upload();
        		    if(!$info) {// 上传错误提示错误信息
        		        $this->error($upload->getError());
        		    }else{// 上传成功 
        		    	 // var_dump($info);
        		    	$data['pic']=$upload->rootPath.$info['pic']['savepath'].$info['pic']['savename'];
        		    	$data['createtime']=time();
        		    	$data['url']=U('Story/update');
        		         $story=M('Story');
        		         if($story->create()){
        		         	$result=$story->add($data);
        		         	if ($result) {
        		         		$this->success('添加成功',U('Story/add'),1);
        		         	}
        		         }
        		    	
        		    }

        	}

}

//更新url
	public function update(){

		$id=I('get.id');

		if(!empty($id)){
			$story=M('story');
			$result=$story->field('id,author,origin,title,intro')->where('id='.$id)->find();
			if($result){
                $this->assign('detail',$result);
                $this->display();
			}else{
				$this->error('非法操作',U('Story/index'),1);

			}

		}else{
			$this->error('非法操作',U('Story/index'),1);
		}

	}


	public function save(){

		if(session('authuser')){
		   
		   return false;

		}
		

		$data['author']=I("post.username");
		$data['title']=I("post.title");
		$data['origin']=I("post.from");
		$data['intro']=I("post.content");
		$id=I("post.id");
		
		if($data['author']==''||$data['title']==''||$data['origin']==''||$data['intro']==''||$id==''){
			$this->error('非法操作',U('Story/update',array('id'=>$id)),1);

		}else{

			$story=M('Story');
			if($story->create()){
				$result=$story->where('id='.$id)->save($data);

				if ($result) {
					$this->success('更新成功',U('Story/index'),1);
				}else{
					$this->error('更新失败',U('Story/update',array('id'=>$id,),1));
				}
			}

		}


	}


}
?>