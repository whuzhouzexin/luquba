<?php
namespace Luquba\Controller;
class AuthController extends BaseController{

	public function auth(){
		$psd=md5(I('post.auth'));
		if($psd==session('au')){
			session('authuser',null);
			$this->success('',U('Index/index'),1);
		}else{
			session('lqb_user',null);
			$this->error('',U('Login/index'),1);
		}

	}
}
?>