<?php
	/**
	 * 公用方法
	 */
	function show($status, $message, $data = null)
	{
		$result = array(
			'status'   => $status,
			'message' => $message,
			'data'   => $data,
		);

		exit(json_encode($result));
	}
