<?php
	namespace Common\Model;
	use Think\Model;

	class NewsContentModel extends Model
	{
		private $_db='';

		public function __construct()
		{
			$this->_db=M('news_content');
		}

		/**
		 * 插入内容
		 * @param array $data
		 *
		 * @return bool|mixed
		 */
		public function insert($data=array()){
			if(!is_array($data) || !$data){
				return false;
			}
			if(!isset($data['content']) || !$data['content']){
				$data['content']= htmlspecialchars($data['content']);
			}

			$data['create_time'] = time();
			return $this->_db->add($data);
		}


		/**
		 * 通过id获取内容能
		 * @param $id
		 * @return mixed
		 */
		public function contentEdit($id){
			if(is_numeric($id)){
				return $this->_db->where('news_id='.$id)->find();
			}
		}

		public function update($news_id,$data){
			if(is_numeric($news_id) && $data['content']){
				$content['content'] =$data['content'];
				$content['update_time']=time();
				return $this->_db->where('news_id='.$news_id)->save($content);
			}
		}
	}
