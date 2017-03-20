<?php
	namespace Admin\Controller;
	class ContentController extends CommonController
	{
		public function index(){
			$this->display();
		}

		/**
		 * 添加加提交
		 */
		public function add(){
			if($_POST){
				if(!isset($_POST['title']) || !$_POST['title']){
					return show(0, '标题不能为空');
				}
				if(!isset($_POST['small_title']) || !$_POST['small_title']){
					return show(0, '短标题不能为空');
				}
				if(!isset($_POST['thumb']) || !$_POST['thumb']){
					return show(0, '缩略图不能为空');
				}
				if(!isset($_POST['title_font_color']) || !$_POST['title_font_color']){
					return show(0, '字体颜色');
				}
				if(!isset($_POST['catid']) || !$_POST['catid']){
					return show(0, '所属栏目不能为空');
				}
				if(!isset($_POST['copyfrom']) || !$_POST['copyfrom']){
					return show(0, '来源不能为空');
				}
				if(!isset($_POST['content']) || !$_POST['content']){
					return show(0, '内容不能为空');
				}
				if(!isset($_POST['keywords']) || !$_POST['keywords']){
					return show(0, '关键词不能为空');
				}
				$res = D('News')->insert($_POST);
				if($res !=false){
					return show(1,$res."插入成功");
				}else{
					show(0,'插入失败');
				}


			}else{

				$webSiteMenu = D('Menu')->getBarMenus();
				$copyFrom = C("COPY_FROM");
				$titleFontColor = C('TITLE_FONT_COLOR');

				$this->assign('webSiteMenu',$webSiteMenu);
				$this->assign('titleFontColor',$titleFontColor);
				$this->assign('copyFrom',$copyFrom);
				$this->assign('test','test11');
				$this->display();
				$webSiteMenu = D('Menu')->getBarMenus();
			}
		}
	}