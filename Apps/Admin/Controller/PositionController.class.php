<?php
	namespace Admin\Controller;

	class PositionController extends CommonController
	{
		public function index()
		{
			$positions = D('Position')->getNormalPositions();

			$this->assign('positions',$positions);
			$this->display();

		}

		//添加推荐位
		public function add(){
			if($_POST &&is_array($_POST)){
				$res = D('Position')->insert($_POST);
				if($res !=false){
					return show(1,"插入成功");
				}else{
					return show(0, '插入失败');
				}
			}
			$this->display();
		}

		//删除
		public function del(){
			$data['url']=$_SERVER['HTTP_REFERER'];
			if($_POST &&is_array($_POST)){
				$res = D('Position')->changeStatus($_POST);
				if($res != false){
					return show(1,'删除成功',$data);
				}else{
					return show(0,'删除失败',$data);
				}
			}else{
				return show(0,'删除失败',$data);

			}
		}

	}
