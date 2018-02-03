<?php
class McryptUrl extends CUrlManager
{
    
    public $_rules=array();
 	public $routeVar='g';
    
    /**
	 * Processes the URL rules.
	 */
	protected function processRules()
	{
		
		if(empty($this->rules) || $this->getUrlFormat()===self::GET_FORMAT)
        {
        	
            $_r  = explode('&',$_GET[$this->routeVar]);
            $_r2 = explode('/',$_r[0]);
            if( !($_r2[0] && strtolower($_r2[0])=="interface") ){
	        	$temp = base64_decode ( urldecode($_GET[$this->routeVar]) );
	        	$temp = explode('&', $temp);
	        	$total = count($temp);
	        	$_GET[$this->routeVar] = $temp[0];//路由
	        	
	        	for($i=1;$i<$total;$i++){
	        		$tempQuery = explode('=',$temp[$i]);
	        		if(!empty( $tempQuery )){
	        			$_GET[$tempQuery[0]]= urldecode($tempQuery[1]);
	        		}
	        	} 
	            return;
            }
        }
			
		if($this->cacheID!==false && ($cache=Yii::app()->getComponent($this->cacheID))!==null)
		{
			$hash=md5(serialize($this->rules));
			if(($data=$cache->get(self::CACHE_KEY))!==false && isset($data[1]) && $data[1]===$hash)
			{
				$this->_rules=$data[0];
				return;
			}
		}
		foreach($this->rules as $pattern=>$route)
			$this->_rules[]=$this->createUrlRule($route,$pattern);
		if(isset($cache))
			$cache->set(self::CACHE_KEY,array($this->_rules,$hash));
	}
    
    
    /**
	 * Creates a URL based on default settings.
	 * @param string $route the controller and the action (e.g. article/read)
	 * @param array $params list of GET parameters
	 * @param string $ampersand the token separating name-value pairs in the URL.
	 * @return string the constructed URL
	 */
	protected function createUrlDefault($route,$params,$ampersand)
	{
		
		//echo $route;exit;
		if($this->getUrlFormat()===self::PATH_FORMAT)
		{
			$url=rtrim($this->getBaseUrl().'/'.$route,'/');
			if($this->appendParams)
			{
				$url=rtrim($url.'/'.$this->createPathInfo($params,'/','/'),'/');
				return $route==='' ? $url : $url.$this->urlSuffix;
			}
			else
			{
				if($route!=='')
					$url.=$this->urlSuffix;
				$query=$this->createPathInfo($params,'=',$ampersand);
				return $query==='' ? $url : $url.'?'.$query;
			}
		}
		else
		{
            $urlQuery = '';
			$url=$this->getBaseUrl();
			if(!$this->showScriptName)
				$url.='/';
			if($route!=='')
			{
				$url .= '?'.$this->routeVar.'=';
                $urlQuery .= $route;
				if(($query=$this->createPathInfo($params,'=',$ampersand))!=='')
					$urlQuery .= $ampersand.$query;
			}
			else if(($query=$this->createPathInfo($params,'=',$ampersand))!==''){
				$urlQuery .= '?'.$query;
            }
            
           $_r = explode('/',$urlQuery);
           if( !($_r[0] && strtolower($_r[0])=="interface") ){
              $urlQuery = urlencode( base64_encode($urlQuery));
           }
            return $url .$urlQuery;
		}
	}
    
}
?>