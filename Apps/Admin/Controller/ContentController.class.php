<?php
	namespace Admin\Controller;
	class ContentController extends CommonController
	{
		public function index(){
			$this->display();
		}
		public function add(){
			$res = D('Menu')->getBarMenus();
			$res =
			$this->display();
		}
	}