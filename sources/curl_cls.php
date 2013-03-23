<?php
require_once('conf.php');
class Curl{
	private $user_agent;
	private $headers;
	private $compression;
	public function Curl(){
		$this->headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		$this->headers[] = 'Connection: Keep-Alive';
		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
		$this->compression='gzip';
	}

	public function login($uri, $user, $pass){
			$data["user"]=$user;
			$data["passwrd"]=$pass;
			$ch = curl_init($uri.URL_LOGIN);
			curl_setopt($ch, CURLOPT_VERBOSE, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
			curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEFILE);
			curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEFILE);
			curl_setopt($ch, CURLOPT_URL, $uri.URL_LOGIN);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			
			curl_setopt($ch, CURLOPT_REFERER, '');
			
			if(curl_exec($ch)){
				curl_close($ch);
				return true;
			}
			curl_close($ch);
			return false;
	}
	public function readParams($uri, $user, $pass){
			$url_post=$uri.URL_POST;
			$process = curl_init($url_post);
			//curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
			//curl_setopt($process, CURLOPT_HEADER, 0);
			curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
			curl_setopt($process, CURLOPT_COOKIEFILE, COOKIEFILE);
			curl_setopt($process, CURLOPT_COOKIEJAR, COOKIEFILE);
			curl_setopt($process,CURLOPT_ENCODING , $this->compression);
			curl_setopt($process, CURLOPT_TIMEOUT, 30);
			curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
			$salida=curl_exec($process);
			preg_match_all('/(name="sc" value="(?<sc>[a-zA-Z0-9]+)")/',$salida, $matches);
			if(isset($matches['sc'][0])){ $sc=$matches['sc'][0]; }else{ return false; }
			preg_match_all('/(name="seqnum" value="(?<seqnum>[a-zA-Z0-9]+))/',$salida, $matches);
			if(isset($matches['seqnum'][0])){ $sequm=$matches['seqnum'][0];}else{ return false; }
			curl_close($process);
			$arr['sc']=$sc;
			$arr['seqnum']=$sequm;
			return $arr;
	
	}
	
	public function preview($url, $msg){
		$prev['message']=$msg;
		$preview=$url.PREVIEW;
		$ch = curl_init(); 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
		curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEFILE);
		curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEFILE);
		curl_setopt($ch, CURLOPT_URL, $preview);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $prev); 
		
		curl_setopt($ch, CURLOPT_REFERER, '');
		if(curl_exec($ch)){
			curl_close($ch);
			return true;
		}
		curl_close($ch);
		return false;
	
	}
	public function post($url,$post_data){
		$url_sendpost=$url.URL_SEND_POST;
		$ch = curl_init(); 
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
		curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEFILE);
		curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEFILE);
		curl_setopt($ch, CURLOPT_URL, $url_sendpost);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
		
		curl_setopt($ch, CURLOPT_REFERER, '');
		if(curl_exec($ch)){
			curl_close($ch);
			return true;
		}else{
			curl_close($ch);
			return false;
		}
		
		
	
	}
}

$curl=new Curl();