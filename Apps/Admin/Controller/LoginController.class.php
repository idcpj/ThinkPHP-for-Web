<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index(){
        return $this->display();
    }
    public function check(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (!trim($username)){
            show(0,md5('admin'));
        }
	    if (!trim($password)){
		    show(0,"密码不能为空");
        }

    }
}