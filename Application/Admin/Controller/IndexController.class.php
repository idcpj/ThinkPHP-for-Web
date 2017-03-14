<?php


namespace Admin\Controller;


use Think\Controller;

class IndexController extends Controller
{
    public function Index(){
        return $this->display();
        //var_dump(C());
    }

}