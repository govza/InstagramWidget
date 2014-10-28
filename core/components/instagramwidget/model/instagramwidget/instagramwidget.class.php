<?php

/**
 * The base class for InstagramWidget.
 */

class InstagramWidget {
	/* @var modX $modx */
	public $modx = null;
	public $data = array();
	public $answer = '';
	public $errors = array(
		101=>'Can\'t get access to cache. Check permissions.',
		102=>'Can\'t get modification time of cache. Cache always be expired.',
		103=>'Can\'t send request. You need the cURL extension OR set allow_url_fopen to "true" in php.ini and openssl extension',
		401=>'Can\'t get correct answer from Instagram API server. <br />If you want send request again, delete cache file or wait cache expiration. API server answer: <br /><br />{$answer}',
		402=>'Can\'t get data from Instagram API server. User OR CLIENT_ID not found.<br />If you want send request again, delete cache file or wait cache expiration.',
	);

	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx,array $config = array()) {
		$this->modx =& $modx;
		$this->config = array_merge(array(
			'LOGIN' =>  $this->modx->getOption('login',$config,'govza'),
			'CLIENT_ID' => $this->modx->getOption('id',$config,'5139563e76d34551810efe80764b4557'),
			'HASHTAG' => $this->modx->getOption('hashtag',$config,''),
			'cacheExpiration' =>  $this->modx->getOption('cacheExpTime',$config,6),
			'imgCount'=> $modx->getOption('limit',$config,12)
		), $config);

		$this->checkConfig();
	}

	public function apiQuery(){
		// -------------------------------------------------
		// Query #1. Try to get user ID and profile picture
		// -------------------------------------------------
		$this->answer = $this->send('https://api.instagram.com/v1/users/search?q='.$this->config['LOGIN'].'&client_id='.$this->config['CLIENT_ID']);
		$answer = json_decode($this->answer);
		if(is_object($answer)){
			if($answer->meta->code == 200 AND !empty($answer->data)){
				foreach ($answer->data as $key=>$item){
					if($item->username == $this->config['LOGIN']){
						$this->data['userid'] 	= $item->id;
						$this->data['username'] = $item->username;
						$this->data['avatar'] 	= $item->profile_picture;
						break;
					}
				}
				if(empty($this->data['userid'])) {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(402));die();}
			}
			else {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(402)); die();}
		}
		else die($this->getError(401));
		// -------------------------------------------------
		// Query #2. Try to get profile statistic
		// -------------------------------------------------
		$this->answer = $this->send('https://api.instagram.com/v1/users/'.$this->data['userid'].'/?client_id='.$this->config['CLIENT_ID'].'');
		$answer = json_decode($this->answer);
		if(is_object($answer)){
			if($answer->meta->code == 200 AND !empty($answer->data)){
				$this->data['posts']	 = $answer->data->counts->media;
				$this->data['followers'] = $answer->data->counts->followed_by;
				$this->data['following'] = $answer->data->counts->follows;
			}
			else {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(402)); die();}
		}
		else {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(401)); die();}
		// -------------------------------------------------
		// Query #3. Try to get photo
		// -------------------------------------------------
		if(!empty($this->config['HASHTAG'])){
			$this->answer = $this->send('https://api.instagram.com/v1/tags/'.urlencode($this->config['HASHTAG']).'/media/recent/?client_id='.$this->config['CLIENT_ID'].'&count='.$this->config['imgCount']);
		}
		else $this->answer = $this->send('https://api.instagram.com/v1/users/'.$this->data['userid'].'/media/recent/?client_id='.$this->config['CLIENT_ID'].'&count='.$this->config['imgCount']);
		$answer = json_decode($this->answer);
		if(is_object($answer)){
			if($answer->meta->code == 200){
				if(!empty($answer->data)){
					$images = array();
					foreach ($answer->data as $key=>$item){
						$images[$key]['link'] 		= $item->link;
						$images[$key]['large'] 		= $item->images->low_resolution->url;
						$images[$key]['fullsize'] 	= $item->images->standard_resolution->url;
						$images[$key]['small'] 		= $item->images->thumbnail->url;
					}
					$this->data['images'] = $images;
				}
				else $this->data['images'] = array();
			}
			else {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(402)); die();}
		}
		else {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(401)); die();}
	}

	public function cacheFilePlace() {
		return MODX_CORE_PATH.'cache/instagramUrlCache.txt';
	}
	public function getData(){
		$this->data = json_decode($this->modx->cacheManager->get('inCache'));
		if(empty($this->data)){
			$this->apiQuery();
			$data = json_encode($this->data);
			$this->modx->cacheManager->set('inCache', $data, ($this->config['cacheExpiration']*60*60));
			$this->data = json_decode($this->modx->cacheManager->get('inCache'));
		}
	}

	public function send($url){
		if(extension_loaded('curl')){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_URL, $url);
			$answer = curl_exec($ch);
			curl_close($ch);
			return $answer;
		}
		elseif(ini_get('allow_url_fopen') AND extension_loaded('openssl')){
			$answer = file_get_contents($url);
			return $answer;
		}
		else {$this->modx->log(modX::LOG_LEVEL_ERROR, $this->getError(103)); die();}
	}
	public function checkConfig(){
		if(!empty($this->config['LOGIN'])){
			$this->config['LOGIN'] = strtolower(trim($this->config['LOGIN']));
		}
		else die('LOGIN required in config.php'.$this->config['LOGIN'].print_r($this->config));
		if(!empty($this->config['CLIENT_ID'])){
			$this->config['CLIENT_ID'] = strtolower(trim($this->config['CLIENT_ID']));
		}
	}


	public function getError($code){
		$this->errors[$code] = str_replace('{$cacheFile}',$this->cacheFile,$this->errors[$code]);
		$this->errors[$code] = str_replace('{$answer}',strip_tags($this->answer),$this->errors[$code]);
		$result = '<b>ERROR <a href="http://inwidget.ru/#error'.$code.'" target="_blank">#'.$code.'</a>:</b> '.$this->errors[$code];
		if($code == 401 OR $code == 402){
			file_put_contents($this->cacheFile,$result,LOCK_EX);
		}
		return $result;
	}
}