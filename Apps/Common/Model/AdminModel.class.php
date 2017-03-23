<?php
	namespace Common\Model;
	use Org\Net\IpLocation;
	use Think\Model;

	class AdminModel extends Model
	{
		private $_db = '';

		/*
		 * 对数据admin模型进行实例化
		 * */
		public function __construct()
		{
			$this->_db = M ('admin');
		}

		//通过username胡获取admin
		public function getAdminByUsername($username)
		{
			$data= $this->_db->where('username="'.$username.'"')->find();
			return $data;
		}

		public function insert($data){
			if(is_array($data)){
				$data['password']=getMd5Password($data['password']);
				return $this->_db->add($data);
			}
		}

		//获取所有
		public function getAll(){
			$cond =array(
				'status'=>1.
			);
			return $this->_db->where($cond)->order('admin_id')->select();
		}

		//删除
		public function del($cond){
			$data['admin_id']=intval($cond['id']);
			$data['status']=intval($cond['status']);
			return $this->_db->save($data);
		}

		//更新最后登录
		public function lastLogin($admin_id){
			if(!$admin_id){
				return false;
			}
			$data['admin_id']=$admin_id;
			$data['lastloginip']=get_client_ip();
			$data['lastlogintime']=time();
			return $this->_db->save($data);

		}

		//更新
		public function update($data){
			if(!$data){
				return false;
			}
			return $this->_db->save($data);
		}

		//今日登录数量
		public function todayUserCount(){
			$todayTime=mktime(0,0,0,date('m'),date('d'),date('Y'));
			$cond=array(
				'status'=>1,
				'lastlogintime'=>array('gt',$todayTime),
			);
			return $this->_db->where($cond)->count();
		}

	}