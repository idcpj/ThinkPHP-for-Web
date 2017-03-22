<?php
	namespace Admin\Controller;
	use Think\Page;

	class PositioncontentController extends CommonController
	{
		public function index(){
			if($_GET['title'] ){
				$condition['title'] =$_GET['title'];
			}
			if($_GET['position_id'] && !empty($_GET['position_id'])){
				$condition['position_id']=$_GET['position_id'];
			}

			$pageSize = 3;
			$p = $_GET['p']?$_GET['p']:1;
			//推荐位内容
			$contents =D('PositionContent')->getContent($condition,$p,$pageSize);
			//数量
			$totalRows =D('PositionContent')->getCount($condition);
			//分页设置

			$pages = (new Page($totalRows,$pageSize))->show();
			//dump($pages);
			//exit;

			//获取分类
			$positions =D('Position')->getNormalPositions();

			//选中selected
			$positionId =$_GET['position_id'];
			$this->assign('pages',$pages);
			$this->assign('positionId',$positionId);
			$this->assign('positions',$positions);
			$this->assign('contents',$contents);
			$this->display();

		}

		//修改
		public function edit(){
			$list = D('PositionContent')->getContentById();

			//推荐位
			$positions=D('Position')->getNormalPositions();

			$this->assign('vo',$list);
			$this->assign('positions',$positions);
			$this->display();

		}

		//添加 更新
		public function add(){
			//更新
			$data['url']= $_SERVER['HTTP_REFERER'];
			if($_POST['id']){

				$id = $_POST['id'];
				unset($_POST['id']);
				$res = D('PositionContent')->update($id,$_POST);
				if($res){
					return show(1,'更新成功',$data);
				}else{
					return show(0,'更新失败',$data);
				}
			}else{
				//推荐位添加
				if($_POST){
					$res = D('PositionContent')->insert($_POST);
					if($res){
						return show(1,'更新成功');
					}else{
						return show(0,'更新失败');
					}
				}

				$positions=D('Position')->getNormalPositions();
				$this->assign('positions',$positions);
				$this->display();
			}
		}

		//排序
		public function listorder(){
			$data['jumpUrl']=$_SERVER['HTTP_REFERER'];
			$error = [];
			if(is_array($_POST)){
				foreach( $_POST['listorder'] as $id=>$value){
					D('PositionContent')->listOder($id,$value);
				}
					return show(1, '添加成功',$data);
			}
		}

		//删除
		public function del(){
			$data['url'] =$_SERVER['HTTP_REFERER'];
			if($_POST['id']){
				$res = D('PositionContent')->del($_POST['id'],$_POST['status']);
				if($res){
					show(1, '操作成功',$data);
				}else{
					return show(0, '操作失败',$data);
				}
			}else{
				return show(0, '操作失败',$data);
			}
		}
	}
