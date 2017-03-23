<?php
	namespace Admin\Controller;
	use Think\Controller;

	class IndexController extends Controller
	{
		public function index()
		{
			if(session('adminUser')){
				//今日用户登录数
				$adminCount=D('Admin')->todayUserCount();
				//文章数
				$newsCount = D('News')->getNewsCount();
				//最大阅读量的文章
				$news = D('News')->getBrank()[0];
				//推荐位数量
				$positionCount = D('Position')->getCount();

				$this->assign('admincount',$adminCount);
				$this->assign('newscount',$newsCount);
				$this->assign('news',$news);
				$this->assign('positioncount',$positionCount);
				$this->display();
			}else{
				$this->redirect(U('Login/index'));
			}
		}




	}