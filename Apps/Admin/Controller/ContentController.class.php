<?php
	namespace Admin\Controller;
	use Common\Model\NewsModel;
	use Common\Model\Position_contentModel;
	use Common\Model\PositionContentModel;
	use Think\Exception;
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

			//分页code
			$page = $_REQUEST['p']?intval($_REQUEST['p']):1;
			$pageSize = 3;

			$news = D('News')->getNews($conds,$page,$pageSize);
			$count =D('News')->getNewsCount($conds);
			$pageres = (new Page($count,$pageSize))->show();

			$positions = D('Position')->getNormalPositions();
			$this->getInfo();


			$this->assign('news',$news);
			$this->assign('positions',$positions);
			$this->assign('pageres',$pageres);
			$this->display();
		}


		/**
		 * 添加提交
		 */
		public function add(){

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
				$data['url']= $_SERVER['HTTP_REFERER'];
				$news_id = D('News')->update($_POST);
				if($news_id !=false ){
					$id = D('NewsContent')->update($_POST['news_id'],$_POST);
					if(is_numeric($id)){
						return show(1, '更新成功',$data);
					}else{
						return show(0, '更新失败',$data);
					}
				}
			}

			$this->getInfo();
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

			$this->getInfo();
			$this->assign('news',$news);
			$this->display();
		}

		/**
		 * 删除或更改显示或关闭
		 */
		public function del(){
			$data['url']='/admin.php?c=content';

			if($_POST && $_POST['id']){
				$news_id = D('News')->delNews($_POST);
				if(is_numeric($news_id)){
					return show(1, '操作成功',$data);
				}else{
					return show(0,'操作失败',$data);
				}
			}else{
				return show(0,'操作失败',$data);
			}
		}

		/**
		 * 排序
		 */
		public function listorder(){
			//跳转到返回页
			$data['jumpUrl']=$_SERVER['HTTP_REFERER'];

			if($_POST['listorder'] && is_array($_POST));
			$post =$_POST['listorder'];
			$error=[];
			try{
				foreach( $post as $newsId=>$v){
					$res = D('News')->newsOrder($newsId,$v);
					if($res ===false){
						$error[]= $newsId;
					}
				}
			}catch(Exception $e){
				return show(0, $e->getMessage(),$data);
			}
			if(empty($error)){
				return show(1,'排列成功',$data);
			}else{
				return show(0, "排列失败",$data);
			}

		}


		//获取option的值
		private function getInfo(){
			////获取前台菜单
			$webSiteMenu = D('Menu')->getBarMenus();
			//获取来源config
			$copyFrom = C("COPY_FROM");
			//获取标签颜色
			$titleFontColor = C('TITLE_FONT_COLOR');

			$this->assign('webSiteMenu',$webSiteMenu);
			$this->assign('titleFontColor',$titleFontColor);
			$this->assign('copyfrom',$copyFrom);
		}

		//推荐位
		public function push(){
			$data['url'] =$_SERVER['HTTP_REFERER'];

			if(is_array($_POST) && $_POST['data'] && $_POST['position_id']){
				//获取新闻
				foreach($_POST['data'] as $key=>$newsId){

					$news=D('News')->getNewsById($newsId);
					//判断获取新闻成功
					if($news!=false){
						$news['position_id']=intval($_POST['position_id']);
						//把新闻放如推荐位
						$res = D('PositionContent')->insert($news);
						if($res ===false){
							return show(0,'推送失败',$data);
						}
					}else{
						return show(0,'推送失败',$data);
					}
				}
				return show(1,"推送成功",$data);
			}else{
				return show(0,'推送失败,没有推送内容',$data);
			}
		}

	}