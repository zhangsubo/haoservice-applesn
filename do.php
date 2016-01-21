<?php
/*
 * Haoservice 苹果序列号查询接口PHP实现
 *
 * Author：Zsuper-PHP
 * Author URL:http://www.zsuper.xyz http://www.zhangsubo.cn
 *
 * Code URL:https://github.com/zhangsubo/juhe-AppleSN
 * Version:1.0.2
 * License:MIT
 *
 * Description:Haoservice是一家数据API提供网站，蓝点FIX项目方要求使用此服务上提供的API接口实现苹果序列号查询功能。因此制作此代码。
 *
 */

header('Content-type:text/html;charset=utf-8');


//配置appkey
$appkey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

//拼接带有参数的查询网址
$url = "http://apis.haoservice.com/lifeservice/AppleInfo";
$params = array(
      "sn" => $_GET['sn'],//苹果产品的序列号或IMEI号
      "key" => $appkey,//配置的key
);
$paramstring = http_build_query($params);
$content = landiancurl($url,$paramstring);

echo $content;

//**************************************************





/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function landiancurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'landianData' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if( $ispost )
    {

        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {

        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}
