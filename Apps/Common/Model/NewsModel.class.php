<?php
	namespace Common\Model;
	use Think\Model;

	class NewsModel extends Model
	{
		private $_db='';

		public function __construct()
		{
			$this->_db= M ('news');
		}

		public function getNewsNum(){
			echo "1";
		}
	}