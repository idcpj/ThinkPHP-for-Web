<?php
	namespace Common\Model;

	use Think\Model;

	class PositionContentModel extends Model{
		private $_db='';

		public function __construct()
		{
			$this->_db=M('PositionContent');
		}

		//添加
		public function insert($data){
			if($data){
				$data['create_time']=time();
				$res = $this->_db->add($data);
			}
			return $res;
		}

		//获取所有内容
		public function getPositionContent(){
			$res = $this->_db->select();
			if(!$res){
				throw_exception("获取推荐位内容失败");
			}
			return $res;
		}

		public function searchPosition($data){
			$condition=array(
				'position_id'=>$data['position_id'],
				'title' =>array('like','%'.$data['title'].'%')
			);
			$res = $this->_db->where($condition)->select();
			return $res;

		}

		//每页新闻
		public function getContent($condition,$p,$pageSize){
			if($condition['title']){
				$cond=array(
					'title'=>array('like','%'.$condition['title'].'%')
				);
			}
			if($condition['position_id'] && !empty($condition['position_id'])){
				$cond['position_id'] =$condition['position_id'];
			}
			$cond['status']=array('neq',-1);
			$page =($p - 1)*$pageSize;
			$res = $this->_db->where($cond)->order('listorder ,id')->limit($page,$pageSize)->select();
			return $res;


		}

		//总新闻数
		public function getCount($condition){
			if($condition['title']){
				$cond=array(
					'title'=>array('like','%'.$condition['title'].'%')
			);
			}
			if($condition['position_id'] && !empty($condition['position_id'])){
				$cond['position_id'] =$condition['position_id'];
			}

			$cond['status']=array('neq',-1);
			$res = $this->_db->where($cond)->count();
			return $res;

		}

		//通过id获取内容
		public function getContentById(){
			if(!empty($_GET['id'])){
				return $this->_db->where('id='.$_GET['id'])->find();
			}
		}

		//更新
		public function update($id,$data){
			if($id){
				$res = $this->_db->where('id='.$id)->save($data);
				return $res;
			}
		}

		//更改listoder顺序
		public function listOder($id,$listOder){
			if($id){
				return $this->_db->where('id='.$id)->save(array('listorder'=>$listOder));
			}
		}

		//删除(更改状态)
		public function del($id,$status){
			if(is_numeric($id)){
				return $this->_db->where('id='.$id)->save(array('status'=>$status));
			}
		}


	}

