<?php
	namespace Admin\Controller;

	use Think\Exception;
	use Think\Upload;

	class ImageController extends CommonController
	{
		const UPLOAD = 'upload';

		/**
		 * 文章缩略图
		 */
		public function ajaxUploadImage(){
			$res = D('UploadImage')->imageUpload();
			if($res===false){
				return show(0, '上传失败,检查上传目录是否存在');
			}else{
				return show(1, '上传成功',$res);
			}
		}

		/*
		 * 编辑器缩略图
		 */
		public function kindUpload(){
			$upload = D('UploadImage');
			$res = $upload->upload();
			if($res==false){
				return showKind(1, "上传失败");
			}else{
				return showKind(0,$res);
			}
		}
	}