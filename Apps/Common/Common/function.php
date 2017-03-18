<?php
	/**
	 *  AJAX返回函数
	 * @param      $status
	 * @param      $message
	 * @param null $data
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
	 * @param $password
	 *
	 * @return string
	 */
	function getMd5Password($password)
	{
		return md5($password.C('MD5_PRE'));
	}

	/*
	 * type判断
	 */
	function getMenuType($data){
		return $data ===1?"后台菜单":"前端导航";
	}

	function status($data){
		switch($data){
			case 1:
				$res = '显示';
				break;
			case 0:
				$res = '关闭';
				break;
			default:
				$res = '删除';
		}
		return $res;
	}
