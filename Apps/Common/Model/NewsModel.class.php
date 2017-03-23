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
			$conditions['status'] = array('neq',-1);

			if(isset($data['title']) && $data['title']){
				$conditions['title'] = array('like','%'.$data['title'].'%');
			}
			if(isset($data['catid']) && $data['catid']){
				$conditions['catid'] = intval($data['catid']);
			}
			if(isset($data['status']) && $data['status']){
				$conditions['status'] = $data['status'];
			}


			$offset = ($page-1)*$pageSize;

			return $res = $this->_db->where($conditions)->order('listorder ,news_id')->limit($offset,$pageSize)->select();
		}

		/**
		 * 获取新闻条数
		 */
		public function getNewsCount($data = array()){
			$conditions['status'] = array('neq',-1);

			if(isset($data['title']) && $data['title']){
				$conditions['title'] = array('like','%'.$data['title'].'%');
			}
			if(isset($data['catid']) && $data['catid']){
				$conditions['catid'] = intval($data['catid']);
			}

			if(isset($data['status']) && $data['status']){
				$conditions['status'] = $data['status'];
			}
			$res= $this->_db->where($conditions)->count();
			return $res;
		}

		/**
		 * 编辑展示
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
		 */
		public function update($data){
			if($data['news_id'] && !$data['count']){
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

		//通过id获取一条新闻
		public function getNewsById($news_id){
			if(is_numeric($news_id)){
				$cond = array(
					'status'=>array('neq',-1),
					'news_id'=>$news_id
				);
				$news =$this->_db->where($cond)->find();
				return $news;
			}else{
				return false;
			}
		}

		//获取新闻
		public function getNewsContent($num=30){
			if($num){
				$cond = array(
					'status'=>1,
					'thumb'=>array('neq',''),
				);

				return $this->_db->where($cond)->limit($num)->select();
			}else{
				return false;
			}
		}

		//获取排行
		public function getBrank($data ,$limit=10){
			return $this->_db->where($data)->order('counts desc ,news_id desc')->limit($limit)->select();
		}


	}
