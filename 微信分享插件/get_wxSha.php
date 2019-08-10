<?php

function wx_get_jsapi_ticket(){
    $ticket = "";
	//从txt中获取token值
	$token = file_get_contents("http://wchat.ejiubo.net/newfile.txt");
	$url2 = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi",$token);
	$res = file_get_contents($url2);
	$res = json_decode($res, true);
	$ticket = $res['ticket'];

    return $ticket;
}

//动态获取当前html的完整链接,包括'http(s)://'部分，以及'？'后面的GET参数部分,但不包括'#'hash后面的部分
$myHref = $_POST['myHref'];
//echo $myHref."1";
$timestamp = time();
//echo "timestamp:".$timestamp."<br />";
$wxnonceStr = "gjgklsdsgjsgj";
$wxticket = wx_get_jsapi_ticket();
// 注意 URL 一定要动态获取，不能 hardcode.
//$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",$wxticket, $wxnonceStr, $timestamp,'http://app.ejiubo.net/test.html?from=singlemessage&isappinstalled=0');
$wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",$wxticket, $wxnonceStr, $timestamp, $myHref);


$wxSha1 = sha1($wxOri);
//echo "signature:".$wxSha1;

$arr = array(
 'timestamp' => $timestamp,
 'signature' => $wxSha1,
 'myHref' => $myHref
);
$json_string = json_encode($arr);
echo $json_string;//json格式的字符串


?>