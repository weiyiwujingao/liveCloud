<?php
class CloudIdentify{
	/*判断用户是否登陆云平台;
	 * */
	public function checkLogin(){
		$user_id = $_COOKIE["Usr_ID"];
	    if(empty($user_id)){
		    return false;
		}else{
		    return true;
		}
	}
	 /*判断传入模块当前用户是否有操作权限，如果有返回true 否则返回false;
	  * @params $module  int 模块ID;
	  * return boolean;
	  * */
	 public static function checkModule($module){
	 	$user_id = $_COOKIE["Usr_ID"];
	 	$url = Yii::app()->params['url'];
	 	$soap = new SoapClient($url);
	 	$r = $soap->get_module_info($user_id,$module);
	 	return $r;
	 }
	/**
	 * 检查权限
	 * $module为接入云平台模块，$fun为接入云平台功能操作，$isfun为是否有操作功能
	 * @return 1有操作权限，0没有权限
	 * $fun 可以传入一个数字，亦可传入数组数据;
	 */
		public static function checkAction($module='',$fun='',$isfun=true){
				$user_id=$_COOKIE["Usr_ID"];
		        $url=Yii::app()->params['url'];  //定义接入云平台接口
				try{
		       	 $soap = new SoapClient($url);
				}catch(CDBException $e){
					 $this->redirect(array('error/error'));
				}
		     	if($isfun){
		     		if(is_array($fun)){
		     			$total = count($fun);
		     			for($i=0;$i<$total;$i++){
		     				$data = explode('|',$soap->get_function_info($user_id,$module,$fun[$i]));
		     				$_errornum[] = $data[0] ;//错误代码
		     				$_error[] = $data[1];//错误信息
		     			}
		     			$re = array($_errornum,$_error);
		     			return $re;
		     		}else{
		     			 try{
		     				$status=explode('|',$soap->get_function_info($user_id,$module,$fun));
		     			 }catch(CDBException $e){
					        $this->redirect(array('error/error'));
					      }
					    if($status[0]==1){
					        return 1;
					    }else{
					        return $status[1];
					    } 
		     		} 
				 }else{
				 	try{
				     	$status=explode('|',$soap->get_module_info($user_id,$module));
				 	}catch(CDBException $e){
					        $this->redirect(array('error/error'));
					      }
				     if($status[0]==1){
				         return 1;
				     }else{
				         return $status[1];
				      } 
				 }
			 }
			  /*日志添加;
	  * @params $module  int 模块ID;
	  * return boolean;
	  * */
	 public static function addLog($param){
	 	$uid = $_COOKIE["Usr_ID"];
		$sid= 10;//项目id
		$gid = $param['gid'];//功能id
		$mid = $param['mid'];//功能id
		$type = $param['type'];//操作类型
		$site = $param['url'];//操作地址
		$node = $param['node'];//操作说明
		$ip = $_SERVER["REMOTE_ADDR"];//当前客户端ip
		$time = date('Y-m-d H:i:s');//
		$charset = 'utf-8';
	 	$url = Yii::app()->params['url'];
	 	$soap = new SoapClient($url);
	    $r = $soap->add_log ($uid,$sid,$mid,$gid,$type,$site,$node,$ip,$time,$charset);
	 	return $r;
	 }
}