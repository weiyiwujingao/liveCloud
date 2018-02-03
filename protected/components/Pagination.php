<?php 
	
class Pagination extends CWidget {
   public $pages;
   public $pagesize;
   public $url;
   public $maxButtonCount = 5;
   public function run() {
	   $page_arr = $purl_arr =array();
	   $current = $this->pages->getCurrentPage()+1;
	   $total = $this->pages->getPageCount();
	   $previous = ($current > 1) ? ($current-1) : 1;
	   $next = ($current < $total) ? ($current+1) : $total;
	   for ($i=0; $i<$total; $i++) {
		   $page_arr[] = $i+1;
		   $purl_arr[] = $this->url($i+1);
	   }
	   
	   $this->render('pagination',array(
		     'pager' => $this->pages,
		     'pages' => $page_arr,
		     'purls' => $purl_arr,
		     'current' => $current,
		     'previous' => $this->url($previous),
		     'next' => $this->url($next),
			 'pagesize'=>$this->pagesize,
             'url'=>$_SERVER['REQUEST_URI'],
			 'first'=>$this->url(1),
			 'last'=>$this->url($total)
	   ));
   }

   public function url($page) { 
     $parse_url=parse_url($_SERVER['REQUEST_URI']);  
     $url_query=isset($parse_url["query"]) ? $parse_url["query"] : ""; //单独取出URL的查询字串  
     if($url_query){  
         $url_query=preg_replace("/page=[^&]*[&]?/i","",$url_query);  
         $url=str_replace($parse_url["query"],$url_query,$_SERVER['REQUEST_URI']);//将处理后的URL的查询字串替换原来的URL的查询字串  
         $url=substr($url,-1,1)=='&'?$url:$url.'&';
         $url.="page=".$page;//在URL后加page查询信息，但待赋值  
     }else{  
        $url.="?page=".$page;  
     }  
   	return $url;
   }
}

?>
