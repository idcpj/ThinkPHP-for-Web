<?php
	namespace Common\Model;
	use Think\Exception;
	use Think\Model;
	use Think\Page;

	class NewsModel extends Model
	{
		private $_db='';

		public function __construct()
		{
			$this->_db=M('News');
		}

		/**
		 * 插入新闻
		 * @param array $data		 *
		 * @return bool|mixed
		 */
		public function insert($data=array()){
			if(!is_array($data) || !$data){
				return false;
			}

			$data['create_time'] = time();
			$data['username'] =getLoginUsername();

			return $res= $this->_db->add($data);

		}

		/**
		 * 新闻分页列表
		 */
		public function getNews($data,$page,$pageSize=10){
			if(isset($data['title']) && $data['title']){
				$conditions['title'] = array('like','%'.$data['title'].'%');
			}
			if(isset($data['catid']) && $data['catid']){
				$conditions['catid'] = intval($data['catid']);
			}
			$conditions['status'] = array('neq',-1);

			$offset = ($page-1)*$pageSize;

			return $res = $this->_db->where($conditions)->order('listorder ,news_id')->limit($offset,$pageSize)->select();
		}

		/**
		 * 获取新闻条数
		 * @param array $data
		 * @return mixed
		 */
		public function getNewsCount($data = array()){
			if(isset($data['title']) && $data['title']){
				$conditions['title'] = array('like','%'.$data['title'].'%');
			}
			if(isset($data['catid']) && $data['catid']){
				$conditions['catid'] = intval($data['catid']);
			}

			$conditions['status'] = array('neq',-1);

			$res= $this->_db->where($conditions)->count();
			return $res;
		}

		/**
		 * 编辑展示
		 * @param $id
		 * @return bool|mixed
		 */
		public function newsEdit($id){
			if(is_numeric($id)){
				return $this->_db->where('news_id='.$id)->find();
			}else{
				return false;
			}
		}

		/**
		 * 更新内容
		 * @param $data
		 * @return bool
		 */
		public function update($data){
			if($data['news_id']){
				$news_id = $data['news_id'];
				unset($data['news_id']);
				$data['update_time']=time();
				return $this->_db->where('news_id='.$news_id)->save($data);
			}else{
				return false;
			}
		}

		/**
		 * 删除新闻
		 * @param $data
		 * @return mixed
		 */
		public function delNews($data){
			if(is_numeric($data['id'])){
				$id=$data['id'];
				unset($data['id']);
				return $this->_db->where('news_id='.$id)->save($data);
			}else{
				false;
			}
		}

		/**
		 * 新闻排序
		 */
		public function newsOrder($newsId,$value){
			if(is_numeric($newsId)){
				$newsId= intval($newsId);
				$res = $this->_db->where('news_id='.$newsId)->save(array('listorder'=>intval($value)));
				if($res===false){
					throw_exception("错误信息:数据库导入错误");
				}else{
					return $res;
				}
			}else{
				return false;
			}
		}

		public function getNewsById($news_id){
			if(is_numeric($news_id)){
				$news =$this->_db->where('news_id='.$news_id)->find();
				return $news;
			}else{
				return false;
			}
		}
	}
