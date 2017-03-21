<?php
	namespace Common\Model;

	//缓存操作

	use Think\Model;

	class BasicModel extends Model
	{
		//Protected $autoCheckFields = false;

		//通过构造函数 D(),可以不连接数据库
		public function __construct()
		{
		}

		//保存配置
		public function saveConfig($data = array()){
			if(!$data){
				throw_exception("没有提交的数据");
			}
			$res = F('basic_web_config',$data);
			return $res;
		}

		//读取配置
		public function getConfig(){
			return F('basic_web_config');
		}

	}