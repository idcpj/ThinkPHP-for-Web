<?php
namespace Home\Controller;

class IndexController extends CommonController {

    public function index(){
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
    	$this->display();
    }




}