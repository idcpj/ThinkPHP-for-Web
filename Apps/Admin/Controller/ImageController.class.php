<?php
	namespace Admin\Controller;
	use Common\Model\UploadImageModel;
	use Think\Exception;

	class ImageController extends CommonController
	{

		private $upload ='';
		public function __construct()
		{
		}

		public function ajaxuploadimage(){
			$res = D('UploadImage')->imageUpload();
			if($res===false){
				return show(0, '上传失败,检查上传目录是否存在');
			}else{
				return show(1, '上传成功',$res);
			}
		}
	}