<?php
	namespace Home\Controller;

	class DetailController extends CommonController
	{
		public function index($type=''){
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
			//$news_data =M('News')->find($id);
			$newsAdd = M('News');
			$sql = "update cms_news set counts=counts+1 where news_id=".$id;
			$newsAdd->execute($sql);

			//文章内容
			$content =D('NewsContent')->contentEdit($id);
			$news['content'] = htmlspecialchars_decode($content['content']);

			$res = array(
				'rankNews'     =>$this->rankNews(),
				'advNews'      =>$this->advNews(),
				//通过catid来判断属于什么分类
				'catid'         =>$news['catid'],
				'news'          =>$news
			);
			$this->assign('result',$res);

			if($type == 'buildHtml'){
				$this->buildHtml('index',HTML_PATH,'Detail/index');
			}else{

				$this->display('Detail/index');
			}
		}

		//预览
		public function view(){
			if(!getLoginUsername()){
				$this->errorTO('没有访问权限');
			}
			//调用index方法,
			//注意此时dispaly必须注明$this->display('Detail/index');
			//否则会调用view.html
			$this->index();
		}

		public function build_html()
		{
			$this->index('buildHtml');

		}

	}