<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
    	set_time_limit(0);
    	$datas = deleteHtmlSpace(getWebContent('https://www.jin10.com/'));
    	//抓时间
    	preg_match_all('/(\d{2}:\d{2}:\d{2})/', $datas, $time);
    	// 抓内容
    	preg_match_all('/<h4>(.+?)<\/h4>/', $datas, $content);

    	// var_dump($content);exit;
    	
    	$contents=$content[1]; 
    	$times=$time[1];
    	$news=[];

    	foreach ($contents as $key => $value)
    	{
    		$n=[
    			"content"=>$value,
				"time"=>$times[$key],
    		];
    		array_push($news, $n);
    	}

    	$this->assign("News",$news);
        return $this->fetch('index');
    }
}
