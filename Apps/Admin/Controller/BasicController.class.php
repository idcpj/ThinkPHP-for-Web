<?php
	namespace Admin\Controller;
	use Common\Model\BasicModel;

	/**每个页面都要保证在登录状态,
	 * @package Admin\Controller
	 */
	class BasicController extends CommonController
	{
		public function index(){
			$config = D('Basic')->getConfig();
			$this->assign('vo',$config);
			$this->display();
		}

		public function add(){
			if($_POST){
				if(!$_POST['title']){
					return show(0,'站点标题不能为空');
				}
				if(!$_POST['keywords']){
					return show(0,'站点关键词不能为空');
				}
				if(!$_POST['description']){
					return show(0,'站点描述不能为空');
				}
				 D('Basic')->saveConfig($_POST);
				return show(1, "配置成功");
			}else{
				return show(0, '没有提交的数据');
			}
		}

	}