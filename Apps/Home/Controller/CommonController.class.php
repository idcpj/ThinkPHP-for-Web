<?php
	namespace Home\Controller;

class CommonController extends \Think\Controller{
	public function __construct()
	{
		header('Content-type:text/html;charset=utf-8');
		parent::__construct();
	}

	//获取排名
	public function getRank(){
		$cond['status']=1;
		$news = D('News')->getBrank($cond,10);
		return $news ;
	}

	//错误页面
	public function errorTO($message=''){
		$message=$message?$message:'系统错误';
		$this->assign('message',$message);
		$this->display('Index/error');
	}

	//广告位
	public function advNews(){
		return $advNews  = D('PositionContent')->getPositionById($position_id=4,$num=2);
	}
	//获取排行
	public function rankNews(){
		return $rankNews = $this->getRank();
	}

}