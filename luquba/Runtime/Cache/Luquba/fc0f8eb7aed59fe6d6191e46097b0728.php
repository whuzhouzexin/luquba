<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>录取吧</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/luquba/Public/css/bootstrap.min.css" rel="stylesheet">
<link href="/luquba/Public//bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="/luquba/Public/js/jquery-2.0.2.js"></script>
<script type="text/javascript" src="/luquba/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/luquba/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/luquba/Public/ueditor/ueditor.all.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default ">
  <div class="container">
      <ul class="nav navbar-nav ">
            
             <li class="<?php echo ($class); ?>"><a href="<?php echo U('Index/index');?>">前台用户管理</a></li>
             <li class="<?php echo ($class1); ?>"><a href="<?php echo U('User/index');?>">后台用户管理</a></li>
             <li class="<?php echo ($class2); ?>"><a href="<?php echo U('Content/index');?>">内容管理管理</a></li>
       </ul>

       <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo U('Login/checkOut');?>">退出登录</a></li>
             
       </ul>
  </div>
</nav>
 	<div class="container">
		<div class="well  well-sm">
			<button type="button" class="btn btn-primary"><a href="<?php echo U('Index/showUser');?>" >用户列表</a></button>
			<button type="button" class="btn btn-primary"><a href="<?php echo U('Index/selectUser');?>">查找用户</a></button>

		</div>
   </div>
<form action="<?php echo U('Auth/auth');?>" method="post" enctype="multipart" style="display:none">
     
       
     <div class="form-group">
       <label for="text">秘钥:</label>
        <input type="text" class="form-control"  name="auth"  >
     </div>

	 <button type="submit" class="btn btn-default">提交</button>
</form>

<script type="text/javascript"src="/luquba/Public/js/index.js" ></script>
</body>
</html>