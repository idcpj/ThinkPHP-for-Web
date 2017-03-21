<?php
	namespace Common\Model;
class PositionModel extends \Think\Model{
	private $_db='';

	public function __construct()
	{
		$this->_db=M('Position');
	}

	/**
	 * 获取正常位的推荐内容
	 * @return mixed
	 */
	public function getNormalPositions(){
		$conditions = array('status'=>1);
		$list= $this->_db->where($conditions)->select();
		return $list;
	}

	//添加推荐位
	public function insert($data){
		if($data){
			$data['create_time']=time();
			$res = $this->_db->add($data);
			return $res;
		}else{
			return false;
		}
	}

	//删除
	public function changeStatus($data){
		if($data['id']){
			$id=$data['id'];
			unset($data['id']);
			$res = $this->_db->where('id='.$id)->save($data);
			return $res;
		}else{
			return false;
		}
	}
}
