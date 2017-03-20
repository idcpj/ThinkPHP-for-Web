<?php
	namespace Admin\Controller;
	use Think\Page;

	class ContentController extends CommonController
	{


		public function index(){
			if($_GET['title']){
				$conds['title']=$_GET['title'];
			}
			if($_GET['catid']){
				$conds['catid']=$_GET['catid'];
				$this->assign('catid',$conds['catid']);
			}


			$page = $_REQUEST['p']?intval($_REQUEST['p']):1;
			$pageSize = 3;

			$news = D('News')->getNews($conds,$page,$pageSize);
			$count =D('News')->getNewsCount($conds);
			$pages = (new Page($count,$pageSize))->show();
			$webSiteMenu = D('Menu')->getBarMenus();

			$this->assign('webSiteMenu',$webSiteMenu);
			$this->assign('news',$news);
			$this->assign('pageres',$pages);
			$this->display();
		}


		/**
		 * 添加提交
		 */
		public function add(){
			//获取前台菜单
			$webSiteMenu = D('Menu')->getBarMenus();
			//获取来源config
			$copyFrom = C("COPY_FROM");
			//获取标签颜色
			$titleFontColor = C('TITLE_FONT_COLOR');

			$this->assign('webSiteMenu',$webSiteMenu);
			$this->assign('titleFontColor',$titleFontColor);
			$this->assign('copyfrom',$copyFrom);

			//判断是来自添加还是修改
			if($_POST && !$_POST['news_id']){

				if(!isset($_POST['title']) || !$_POST['title']){
					return show(0, '标题不能为空');
				}
				if(!isset($_POST['small_title']) || !$_POST['small_title']){
					return show(0, '短标题不能为空');
				}
				if(!isset($_POST['title_font_color']) || !$_POST['title_font_color']){
					return show(0, '字体颜色');
				}
				if(!isset($_POST['catid']) || !$_POST['catid']){
					return show(0, '所属栏目不能为空');
				}
				if(!isset($_POST['keywords']) || !$_POST['keywords']){
					return show(0, '关键词不能为空');
				}
				////添加新闻,返回id
				$newsId = D('News')->insert($_POST);
				if($newsId){
					$newsContent['content'] = $_POST['content'];
					$newsContent['news_id'] = $newsId;
					$conentId= D('NewsContent')->insert($newsContent);
					if($conentId){
						return show(1,'插入成功');
					}else{
						return show(0,'主表插入成功,父表插入失败');
					}
				}else{
					return show(1,'主表插入失败');
				}
			}else{
				//修改新闻
				$news_id = D('News')->update($_POST);
				if($news_id !=false ){
					$id = D('NewsContent')->update($news_id,$_POST);
					if(is_numeric($id)){
						return show(1, '更新成功');
					}else{
						return show(0, '更新失败');
					}
				}
			}

			$this->display();
		}

		/**
		 * 编辑页展示
		 */
		public function edit(){
			if($_GET['id']){
				$news = D('News')->newsEdit($_GET['id']);
				if($news !=false){
					$news['content'] = D('NewsContent')->contentEdit($_GET['id'])['content'];
				}
			}
			$title_font_color = C('TITLE_FONT_COLOR');
			$webSiteMenu =D('Menu')->getBarMenus();
			$copyfrom =C('COPY_FROM');

			$this->assign('titleFontColor',$title_font_color);
			$this->assign('news',$news);
			$this->assign('webSiteMenu',$webSiteMenu);
			$this->assign('copyfrom',$copyfrom);
			$this->display();
		}
	}