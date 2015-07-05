<?php
namespace Luquba\Controller;
use Think\Controller;
class LoginController extends Controller{

	private $username='luquba';

	public function login(){

		 layout(false);

	    $this->display();

	}

	public function loginOk(){

		$this->success('',U('Index/index'),'-1');
	}

	public function vertify(){

		$config =    array(
		    'fontSize'    =>    14,    // 验证码字体大小
		    'length'      =>    5,     // 验证码位数
		    'useNoise'    =>    false,
		    'imageW'=>120,
		    'imageH'=>36 // 关闭验证码杂点
		);
	    $Verify = new \Think\Verify($config);
	    $Verify->entry();
	}

	public function doLogin(){
         
         $code=I('post.vertify');
		 $verify = new \Think\Verify();
		 if(!($verify->check($code))){
            $data="202";
			$this->ajaxReturn($data,'json');

		}else{
			$user=I('post.username');
			$pass=md5(I('post.pass'));
			if(empty($user)||empty($pass)){
				$data="204";
				$this->ajaxReturn($data,'json');

			}else{
				$admin=M('admin');
				$userName=$admin->field('admin_type,username,admin_auth')->where("password='%s' and username='%s'",array($pass,$user))->find();
				if($userName['admin_type']!='admin'){
					$data="203";
				    $this->ajaxReturn($data,'json');
				}else{
                    $this->username=md5($this->username);
					session('lqb_user',$this->username);
					session('user',$userName['username']);
					session('authuser',$userName['username']);
					session('au',$userName['admin_auth']);
					$data="250";
				    $this->ajaxReturn($data,'json');
					
				}
			}
			

		}

		
	}

	public function checkOut(){

		session('lqb_user',null);
		
		$this->success('欢迎下次再来,我的主人',U('Login/login'),'1');
              

	}


}

?>