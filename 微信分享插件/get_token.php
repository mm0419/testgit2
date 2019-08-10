<?php
function wx_get_token() {

	//这里需要填写当前公众号的appid和appsecrit
	$res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='            .wx5e21019f7d25a78b.'&secret='.a49bc1f9186f483fa0da6915d8eecb66);
	print $res;
	$res = json_decode($res, true);
	$token = $res['access_token'];
	// 注意：这里需要将获取到的token缓存起来（或写到数据库中）
	// 不能频繁的访问https://api.weixin.qq.com/cgi-bin/token，每日有2000次限制
	// 通过此接口返回的token的有效期目前为2小时。令牌失效后，JS-SDK也就不能用了。
	// 因此，这里将token值缓存1小时，比2小时小。缓存失效后，再从接口获取新的token，这样就可以避免token失效。
	//$('access_token', $token, 3600);
		
    echo $token;	//return不能存到txt中 echo可以 所以这里将return改为echo
	
	//将数组存到指定的text文件中进行保存  
    file_put_contents("newfile.txt",$token);   
	
}

wx_get_token();

?>