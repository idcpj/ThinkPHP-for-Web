<?php
	namespace Home\Controller;

	class DetailController extends CommonController
	{
		public function index(){
			$id = intval($_GET['id']);
			if(!$id || $id<0){
				$this->errorTO('ID不合法');
			}
			//获取文章列表
			$news = D('News')->getNewsById($id);

			if(!$news || $news['status']!=1 ){
				$this->errorTO('ID不存在或已删除');
			}
			//文章加1
			$count =intval( $news['count'])+1;
			dump($count);
			$res = D('News')->countAddOne($id,$count);
			//if(!$res){
			//	$this->errorTO("文章+1失败");
			//}
			//文章内容
			$news['content'] = htmlspecialchars_decode(D('NewsContent')->contentEdit($id));
			dump($news);

			$res = array(
				'rankNews'     =>$this->rankNews(),
				'advNews'      =>$this->advNews(),
				'catid'         =>31,
				'news'          =>$news
			);
			$this->assign('result',$res);
			$this->display();
		}

	}