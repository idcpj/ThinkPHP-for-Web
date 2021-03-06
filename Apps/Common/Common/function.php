<?php

	function test($var){
		dump($var);
		exit();
	}
	/**
	 *  AJAX返回函数
	 */
	function show($status, $message, $data = null)
	{
		$result = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data,
		);
		exit(json_encode($result));
	}

	/**
	 *先通过此方法构建admin管理用户
	 */
	function getMd5Password($password)
	{
		return md5($password.C('MD5_PRE'));
	}

	/*
	 * type判断
	 */
	function getMenuType($data){
		return $data ==1?"后台菜单":"前端导航";
	}

	/**
	 * 状态
	 */
	function status($data){
		switch($data){
			case 1:
				$res = '显示';
				break;
			case 0:
				$res = '隐藏';
				break;
			default:
				$res = '删除';
		}
		return $res;
	}

	/**
	 * 获取后台菜单链接
	 */
	function getAdminMenuUrl($nav){
		$url = '/admin.php?c='.$nav['c'].'&a='.$nav['f'];
		if($nav['c']=='index'){
			$url = '/admin.php';
		}
		return $url;
	}

	/**
	 * 菜单栏高亮
	 */
	function getActive($navC){
		$c = strtolower(CONTROLLER_NAME);
		if($c == strtolower($navC)){
			return 'class = "active"';
		}
			return '';
	}

	/**
	 * 编辑器返回json
	 */
	function showKind($status,$data){
		header('Content-type:application/json,charset=UTF-8');
		if($status==0){
			exit(json_encode(array('error'=>0,'url'=>$data)));
		}
			exit(json_encode(array('error'=>1,'message'=>"上传失败")));
	}

	/**
	 * 获取登录username
	 */
	function  getLoginUsername(){
		return $_SESSION['adminUser']['username'];
	}

	/*
	 * 获取分类名称
	 */
	function getMenuName($menu_id){
		$res = D('Menu')->getMenusById($menu_id);
		return $res['name'];
	}

	//来源
	function getconyFrom($copyFrom){
		return C('COPY_FROM')[$copyFrom];
	}

	/**
	 * 缩略图
	 */
	function getThumb($thumb){
		if($thumb){
			return '<span style="color: red"><img height="20%" align="center" src='.$thumb.' alt="缩略图"></span>';
		}else{
			return '无';
		}
	}
