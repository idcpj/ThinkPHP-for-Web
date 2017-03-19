<?php

	namespace Common\Model;

	use Think\Model;
	use Think\Upload;

	class UploadImageModel extends Model
	{
		private $_uploadObj = '';
		const UPLOAD = 'upload';

		public function __construct()
		{
			$this->_uploadObj = new Upload();
			$this->_uploadObj->rootPath=APP_PATH.self::UPLOAD.'/';
			////通过时间进行文件夹的分类
			$this->_uploadObj->subName = date(Y).'/'.date(m).'/'.date(d);
			$this->ceateDir();
		}

		public function imageUpload(){
			$res =$this->_uploadObj->upload();
			if(is_array($res)){
				return APP_PATH.self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
			}else{

				throw_exception($this->_uploadObj->getError());
			}
		}

		public function ceateDir(){
			$dir=APP_PATH.self::UPLOAD.'/'.date(Y).'/'.date(m).'/'.date(d);
			if(!is_dir($dir)){
				mkdir($dir,0777,true);
			}
		}

}