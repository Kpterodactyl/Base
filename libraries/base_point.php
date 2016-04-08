<?php

class Base_point{

	static function login_point($e, $token) {
		$base_point = O('base_point');
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$base_point->user = O('user',['token' => $token]);
		$base_point->sid = session_id();
		$base_point->address = Base_point::getIp();
		$base_point->browser= Base_point::getBrowser();
		$base_point->dtstart = time();		
		$base_point->save();

	}
 
    static function getIp()  
    {  
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {  
            $ip = $_SERVER["HTTP_CLIENT_IP"];  
        }  
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //获取代理ip  
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
        }  
        if ($ip) {  
            $ips = array_unshift($ips, $ip);  
        }  
          
        $count = count($ips);  
        for ($i = 0; $i < $count; $i++) {  
            if (!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) { //排除局域网ip  
                $ip = $ips[$i];  
                break;  
            }  
        }  
        $tip = $ip ? $ip : $_SERVER['REMOTE_ADDR'];  
        if ($tip == "127.0.0.1") { //获得本地真实IP  
            return $this->get_onlineip();  
        } else {  
            return $tip;  
        }  
    }
    static function getBrowser()  
    {  
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {  
            $br = $_SERVER['HTTP_USER_AGENT'];  
            return $br;  
        } else {  
            return "获取浏览器信息失败！";  
        }  
    }  
	static function logout_point($e, $token){
		$user = O('user',['token' => $token]);
		$sid = session_id();
		
		$point = O('base_point', [
				'user' => $user,
				'sid' => $sid,
				'dtend' => 0
			]);
        error_log("logout get point => ". $point->id);
		if($point->id){
			$point->dtend = Date::time();
			$point->save();
		}
		
	}
}