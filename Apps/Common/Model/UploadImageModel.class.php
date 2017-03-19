<?php

	namespace Common\Model;

	use Think\Upload;

	class UploadImageModel extends Model
	{

		private $_uploadObj = '';
		const UPLOAD = 'upload';

		public function __construct()
		{
			$this->_uploadObj = new Upload();
			$this->_uploadObj->rootPath='./'.self::UPLOAD.'/';
			////通过时间进行文件夹的分类
			$this->_uploadObj->subName = date(d).'/'.date(d).'/'.date(d);
	}

}