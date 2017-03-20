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

		/**上传缩略图
		 * @return string
		 */
		public function imageUpload(){
			//调用tp自带函数
			$res =$this->_uploadObj->upload();
			if(is_array($res)){
				return APP_PATH.self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
			}else{
				throw_exception($this->_uploadObj->getError());
			}
		}

		/**
		 * 上传编辑器图片
		 * @return string
		 */
		public function upload(){
			$res =$this->_uploadObj->upload();
			if($res ==false){
				return false;
			}else{
				return APP_PATH.self::UPLOAD.'/'.$res['imgFile']['savepath'].$res['imgFile']['savename'];
			}
		}

		/**
		 * 创建目录
		 */
		public function ceateDir(){
			$dir=APP_PATH.self::UPLOAD.'/'.date(Y).'/'.date(m).'/'.date(d);
			if(!is_dir($dir)){
				mkdir($dir,0777,true);
			}
		}

}