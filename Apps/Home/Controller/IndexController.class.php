<?php
namespace Home\Controller;

class IndexController extends CommonController {

    public function index($type=''){
    	//获取首页大图
	    $topPicNews  = D('PositionContent')->getPositionById($position_id=1,$num=3);
	    //首页三张小图推荐
	    $topSmailNews  = D('PositionContent')->getPositionById($position_id=3,$num=3);
	    //新闻列表
	    $listNews = D('News')->getNewsContent($num=30);

	    $res = array(
	        'topPicNews'   => $topPicNews,
	        'topSmailNews' => $topSmailNews,
	        'listNews'     =>$listNews,
	        'rankNews'     =>$this->rankNews(),
	        'advNews'      =>$this->advNews(),
	        'catid'         =>31,
	    );
	    $this->assign('result',$res);

	    //静态化判断
	    if($type == 'buildHtml'){
			$this->buildHtml('index',HTML_PATH,'Index/index');
	    }else{

		    $this->display();
	    }
    }
    //计数器
	public function getCount(){
    	foreach($_POST as $key=>$newsId){
    		$res =  M('News')->find($newsId);
    		$data[$newsId] = $res['counts'];
	    }
	    return show(1,'',$data);
	}


    //生成首页静态化
    public function build_html()
    {
	    $this->index('buildHtml');
	    return show(1,"首页静态页面缓存成功");
    }

     //通过crontal linux定时任务操作
    public function crontab_build_html()
    {
    	if(APP_CRONTAB !=1){
    		die('the file mast exec by crontab');
	    }
	    $result=  D('Basic')->getConfig();
    	if(!$result['cacheindex']){
    		die('系统没有设置开启自动生成缓存');
	    }
	    $this->index('buildHtml');
    }


}