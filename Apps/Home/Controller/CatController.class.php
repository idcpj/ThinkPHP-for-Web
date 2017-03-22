<?php
	namespace Home\Controller;

	use Think\Page;

	class CatController extends CommonController{

		public function index(){
			//判断id
			$id = intval($_GET['id']);
			if(!$id){
				return $this->errorTO('ID不存在');
			}
			//点击首页则 跳转到首页
			if($id==31){
				return $this->redirect('/');
			}
			//判断内容
			$nav = D('Menu')->getTypeMenu($id);
			if(!$nav){
				return $this->errorTO('文章内容不存在或已被删除');
			}

			//分页code
			$page = $_REQUEST['p']?intval($_REQUEST['p']):1;
			$pageSize = 5;
			$conds=array(
				'status' => 1,
				'thumb'  => array('neq','',),
				'catid' =>$id
			);
			$news = D('News')->getNews($conds,$page,$pageSize);
			$count =D('News')->getNewsCount($conds);
			$pageres = (new Page($count,$pageSize))->show();


			$res = array(
				'advNews'      =>$this->advNews(),
				'rankNews'     =>$this->rankNews(),
				'catid'         =>$id,
				'pageres'=>$pageres,
				'listNews' =>$news
			);
			$this->assign('result',$res);
			$this->display();

		}
	}

