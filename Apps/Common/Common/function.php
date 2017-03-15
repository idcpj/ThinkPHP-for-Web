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
