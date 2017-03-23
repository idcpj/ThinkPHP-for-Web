<?php
	namespace Admin\Controller;
	class CronController
	{
		public function mysqldump(){
			$data =D('Basic')->getConfig();
			if(!$data['dumpsql']){
				dir('系统没有设置开启自动备份');
			}


			$shell = "mysql -u".C('DB_USER')." -p".C('DB_PWD')." ".C('DB_NAME')." > /temp/cms_".date('Ymd').".sql";
			exec($shell);
		}

	}