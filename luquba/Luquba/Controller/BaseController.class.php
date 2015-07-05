<?php
namespace Luquba\Controller;
use \Think\Controller;
class BaseController extends Controller{

  private $username='luquba';

	public function _initialize(){

          $sesion=session('lqb_user');
          $this->username=md5($this->username);
         
          if($sesion!= $this->username){
            
             	 $this->error('非法访问',U('Login/login'),1);

          }





          }

	}
// }

?>