<?php

class ShowController extends Controller
{
	private $mod  = 'Livestock';
	/*判断是否有相对应的权限*/
	private $model = array(1=>2632,2=>2633,3=>2634,4=>2635,5=>2636,6=>2637,7=>2638,8=>77,9=>2640,10=>2707,11=>2937,12=>2947);
	
public function actionUploadImg(){
		$conn = Yii::app()->db2; //获取数据库连接对象;
		$this->layout = "//layouts/column3";
//		
		    $images = new Images("file");
			//}
			$path = $_POST['path'];
			
			if ($_GET['act'] == 'cut'){	
				//var_dump($_FILES['file']);exit;
				$path_arr = explode("//",$path);
				$image = "/home/httpd/".$path_arr[1];
				$res = $images->thumb($image,false,1);
				if($res == false){
					echo "裁剪失败";
				}elseif(is_array($res)){
					$res['big'] = "http://images.cnfol.com/articles/".basename($res['big']);
					$res['small'] = "http://images.cnfol.com/articles/".basename($res['small']);
					echo '<img src="'.$res['big'].'" style="display: none; margin:10px;">';
					echo '<img id=\'smallImg\' src="'.$res['small'].'" style="display: none; margin:10px;">';
				}elseif(is_string($res)){
					echo '<img src="'.$res.'">';
				}
			}elseif(isset($_GET['act']) && $_GET['act'] == "upload"){
				//var_dump($_FILES['file']);exit;
				$path = $images->move_uploaded();
//				var_dump($path);exit;
				$path = str_replace('//', '/', $path);
				$images->thumb($path,false,0);//文件比规定的尺寸大则生成缩略图，小则保持原样
			if($path == false){
				$images->get_errMsg();
			}else{
				/*存入图片库*/
				//获取用户真实姓名
				
				
				$url = Yii::app()->params['url'];
	 			$soap = new SoapClient($url);
		    	$user_info=$soap->get_userinfo($_COOKIE["Usr_ID"]);
		    	
		    	$realname = $user_info["Usr_RealName"];
				preg_match('/(.+)(\.[^\.]+)$/', $_FILES["file"], $temp);
				
				$info_arrs = pathinfo($path);//图片文件信息
				$base = pathinfo(basename($path));
				
				$name       = "暂无图片说明哦";
				$fname      = $base["filename"];
				$classid    = 26;
				$type       = strtolower($info_arrs["extension"]);
				$minetype   = $_FILES["file"]['type'];
				$size       = $_FILES["file"]['size'];
				$createdtime= time();
				$lastupdate = time();
				$uploaduser = $realname;
				
				$insert_sql = "INSERT INTO pic (`id`,`name`,`filename`,`classid`,`type`,`mimetype`,`size`,`createdtime`,`lastupdate`,`uploaduser`) 
		                                VALUES (
		                                NULL , '$name', '$fname', '$classid','$type','$minetype','$size','$createdtime','$lastupdate','$realname'
		                                );";
				$r = $conn->createCommand( $insert_sql )->execute();
				
				$path = "http://images.cnfol.com/articles/".basename($path) ;
				
				
			}
		}
			$this->render('imgUp',array('path'=>$path));
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	
	public function actionShowlist(){

		
	   $this->layout = "//layouts/column3";
		
	

		/*获取类别id,用于判断权限*/
			$cid=1;
			if(isset($_GET['cid']))$cid=$_GET['cid'];

		
			if(isset($_GET['uid']))
			{
				 $user = new Rs_user();
	             $rs =$user->findByPk($_GET['uid']);
				 if($rs->classid)
				{
				  $class=new Rs_class();
				  $csid =$class->findByPk($rs->classid);
				  if($csid->quotation)
				  {
					$cid=$csid->quotation;
				  }
				}
			}
			
		/*获取类别id,用于判断权限*/
				
	/*判断权限*/
	
		$add = $edit = $del = true;
		$ModID = Yii::app()->params['Permission']['show']['module'];//模块ID
		$AddID = Yii::app()->params['Permission']['show']['Addshow'];//添加功能
		$EditID = Yii::app()->params['Permission']['show']['Saveshow'];//编辑功能
		$DelID = Yii::app()->params['Permission']['show']['Delshow'];//删除功能
		$ModID = $this->model[$cid];//相对应类别的权限
		
		
	//	$_msg = CloudIdentify::checkAction($ModID,array($AddID,$EditID,$DelID,$Gold));//检验用户是否有权
		
		$_msg = CloudIdentify::checkAction($ModID,array($AddID,$EditID,$DelID));
		
		$all = $_msg[0];//所有的错误代码
		if($all[0]!=1){//没有权限  添加
			$add = false;
		}
		if($all[1]!=1){//没有权限  修改
			$edit = false;
		}
		if($all[2]!=1){//没有权限  删除
			$del = false;
		}

		/*判断一个模块是否有权限访问*/
	//	if($all[3]!=1) echo '没有权限访问该类别';



		        $params = (isset($_GET)&& !empty($_GET))?$_GET:'';//搜索参数
				$params['cid']=$cid;
		        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;//初始值
				$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : Yii::app()->params['postsPerPage'];

				
		        $show = new Rs_show();
				
				
				
		        $data = $show->showList($params,$page,$pagesize);

				

				
				
			
		        $showclass = new Rs_class();
	            $classlist =$showclass->getclasslist();
				
	            $user = new Rs_user();
	            $userlist =$user->getuserlist($cid);

				

				
				if(isset($_GET)&& !empty($_GET)){
				 /*写日志*/	
				$param = array(
				'mid'=>77,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>4,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Show/Showlist'),//操作地址
				'node'=>'路演管理-搜索',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				}
		        $this->render('LuyList',array(
	                                    'count'=>$data['count'],
	                                    'showList'=>$data['list'],
		                                'classlist'=>$classlist,
		                                'userlist'=>$userlist,
	                                    'pages'=>$data['pager'],
									    'pagesize'=>$pagesize,
									    'currentPage'=>$page,
		       			 				'add'=>$add,
								        'edit'=>$edit,
								        'del'=>$del, 
										'cid'=>$cid,
	                          ));  
	                          
			}
			
    /*auther by yuexl
	 * date 2012-7-6
	 * description:删除路演
	 */
    public function actionDelshow(){
			$id = Yii::app()->getRequest()->getPost("id");/*要删除的记录ID*/
			$ids=  explode( ',',$id);
		    foreach ($ids as $showid) {
		    	if(is_numeric($showid)){
		    	$model = Rs_show::model()->findByPk($showid);
				$return = $model->Delshow($showid);
		     }
		    }
			if( $return ){
			    /*写日志*/	
				$param = array(
				'mid'=>77,//在云平台上的模块id
				'gid'=>2,//在云平台上的功能id
				'type'=>3,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Show/Showlist'),//操作地址
				'node'=>'路演管理-删除',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				$result = array('errorno'=>'000','msg'=>'');
			}else{
				$result = array('errorno'=>'405','msg'=>'删除失败,请重试!');
			}
			echo json_encode($result);
	}
	
   /*desciption:验证路演名称是否已经存在
	 * @params   $name 路演名称  字符串
	 * */
	public function actioncheckisexist(){
		$re = Rs_show::model()->checkNameIsExist( Yii::app()->getRequest()->getPost("Name") );
		if( $re ){
			$msg = '该路演已存在';
			$errorno = '405';
		}else{
			$msg = '';
			$errorno = '000';
		}
		echo json_encode(array('errorno'=>$errorno,'msg'=>$msg));
	}
	
	
	public function actionAddshow(){
			$obj = new stdClass();
			$request = Yii::app()->getRequest();
			$show = new Rs_show();
//			
		    $topic = trim ( $request->getPost ( "Addtopic" ) );	
		    $starttime = strtotime(trim ( $request->getPost ( "Astarttime" ) ));
		    $endtime = strtotime(trim ( $request->getPost ( "Aendtime" ) ));
		    $showip = trim ( $request->getPost ( "Ashowip" ) ); 
		    $memo = trim ( $request->getPost ( "Amemo" ) );	
		    $addtime = time();
		    $onlinenum1 = trim ( $request->getPost ( "Aonlinenum1" ) );
		    $onlinenum2 = trim ( $request->getPost ( "Aonlinenum2" ) );
		    $showproc = trim ( $request->getPost ( "Ashowproc" ) );
			$procdesc = trim ( $request->getPost ( "Aprocdesc" ) );
		    $topicpic = trim($request->getPost("Atopicpic"));//照片

			
			
		
			/*新需求频道链接去掉了，保持原先兼容，保留字段*/
		    $channlename = '';
		    $channlelink = '';
			/*新需求频道链接去掉了，保持原先兼容，保留字段*/
			
			/*添加视频字段*/
			$player_num= trim ( $request->getPost ( "Aplayer_num" ) );
			$showplayer= trim ( $request->getPost ( "Ashowplayer" ) );
			/*添加视频字段*/

		    $hits =0;
			$addtime = time();

		   $userid = trim ( $request->getPost ( "Auserids" ) );
		   $admin = trim ( $request->getPost ( "Aadmin" ) );	
			

			/*类别id、嘉宾介绍链接、历史记录，公司介绍，兼容原先所以保留该字段*/
			
			$descurl ='';/*嘉宾介绍链接*/
			$classid='';/*关联列表id*/
			$showdesc = 1;

			$historydesc = '';
			$showhistory = 0;	
			$corpdesc = '';
		    $showcorp =0;

			/*获取用户信息*/
			if($userid)
			{
				$userdetail=Rs_user::model()->findByPk($userid);
				$descurl =$userdetail->user_descurl;
				$classid.=$userdetail->classid.',';
			}

			/*获取主持人信息*/
			if($userid)
			{
				$userdetail=Rs_user::model()->findByPk($admin);
				$classid.=$userdetail->classid;
			}
			$cloud_user=$_COOKIE['RealName'];
			

 		/*类别id、嘉宾介绍链接、历史记录，公司介绍，兼容原先所以保留该字段*/		    
				$sid = $show->addShow($topic,$starttime,$endtime,$showip,$descurl,$memo,$addtime,$onlinenum1,$onlinenum2,$corpdesc,$procdesc,$historydesc,$showcorp,$showproc,$showhistory,$topicpic,$showdesc,$channlename,$channlelink,$hits,$userid,$player_num,$showplayer,$admin,$cloud_user);
				if($sid){
				/*写日志*/	
				$param = array(
				'mid'=>77,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>1,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Show/Showlist'),//操作地址
				'node'=>'路演管理-添加',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				$obj->errorno = '1000';
				$obj->error = '添加成功!'; 
				}else{
					$obj->error = '添加失败!';
				}
				if(!empty($classid)){
				$ids=  explode( ',',$classid);
				    foreach ($ids as $showid) {
				    	if(is_numeric($showid)){
				    	Rs_show_class::model()->addShowclass($sid,$showid,$addtime);
				     }
				    }		
				}
				
				/*兼容*/
				$userid=$userid.','.$admin;

				if(!empty($userid)){
					$m=  explode( ',',$userid);
					       $i=0;
						    foreach ($m as $n) {						    	
						    	if(is_numeric($n)){
							    	$ret = Rs_user::model()->checkuserisadmin($n);									    
						           }
						           if($ret[0]['isadmin'] == 1)	{
									    $i++;
									    } 							           				           
						        }
						        if($i>=1){
                                      foreach ($m as $uid) {
	                                      	if(is_numeric($uid)){
								    	            $ret = Rs_user::model()->checkuserisadmin($uid);
	                                      	}
						                    Rs_show_user::model()->addShowuser($sid,$ret[0]['cid'],$uid);
                                         }
						           }else{
						           	 $obj->errorno = '1001';
						             $obj->error = '所邀请的嘉宾中必须包含一位主持人!';
						           }	         
				}
				echo json_encode ( $obj );
		
		}
		
		
		
		public function actionGetshowmsg(){
		    $obj = new stdClass ();
			$showMsg = $showDetail = array ();
			$request = Yii::app ()->getRequest ();
			if ($request->getPost ( "Id" )) {	
				$showMsg = Rs_show::model ()->findByPk($request->getPost ( "Id" ));
				//@error_log(print_r($showMsg,true).'|'.$request->getPost ( "Id" ).date('ymd-Hi').PHP_EOL,3,'/var/tmp/houtaicesho.log');
				if ($showMsg) {
					$showDetail = array (
					$showMsg->id, 
					$showMsg->topic, 
					$showMsg->topicpic,
					$showMsg->starttime,
					$showMsg->endtime,
					$showMsg->showip,
					$showMsg->descurl,
					$showMsg->showdesc,
					$showMsg->historydesc,
					$showMsg->showhistory,
					$showMsg->corpdesc,
					$showMsg->showcorp,
					$showMsg->procdesc,
					$showMsg->showproc,
					$showMsg->channlename,				
					$showMsg->channlelink,
					$showMsg->onlinenum1,
					$showMsg->onlinenum2,
					$showMsg->memo,
					$showMsg->hits,
					$showMsg->player_num,
					$showMsg->userid,
					$showMsg->showplayer,
					$showMsg->admin,
					);
					$obj->errorno = '000';
					$obj->content = implode ( '|', $showDetail );
				} else {
					$obj->errorno = '001';
					$obj->content = '参数错误';
				}
			}
			echo json_encode ( $obj );
	}
	
	
		public function actionSaveshow(){
			        $obj = new stdClass ();
					$request = Yii::app ()->getRequest ();
					$id = $request->getPost ( "aid" );
					$topic = trim ( $request->getPost ( "edittopic" ) );	
				    $starttime = strtotime(trim ( $request->getPost ( "estarttime" ) ));
				    $endtime = strtotime(trim ( $request->getPost ( "eendtime" ) ));
				    $showip = trim ( $request->getPost ( "eshowip" ) );
				    $memo = trim ( $request->getPost ( "ememo" ) );	
				    $addtime = time();
				    $onlinenum1 = trim ( $request->getPost ( "eonlinenum1" ) );
				    $onlinenum2 = trim ( $request->getPost ( "eonlinenum2" ) );
				    $procdesc = trim ( $request->getPost ( "eprocdesc" ) );
				    $showproc = trim ( $request->getPost ( "eshowproc" ) );
				    $topicpic =	trim($request->getPost("etopicpic"));//照片		
					$addtime = time();




			/*新需求频道链接去掉了，保持原先兼容，保留字段*/
		    $channlename = '';
		    $channlelink = '';
			/*新需求频道链接去掉了，保持原先兼容，保留字段*/
			
			/*添加视频字段*/
			$player_num= trim ( $request->getPost ( "eplayer_num" ) );
			$showplayer= trim ( $request->getPost ( "eshowplayer" ) );
			/*添加视频字段*/

		 
			/*嘉宾和主持人*/
		   $userid = trim ( $request->getPost ( "euserids" ) );
		   $admin = trim ( $request->getPost ( "eadmin" ) );	
			

			/*类别id、嘉宾介绍链接、历史记录，公司介绍，兼容原先所以保留该字段*/
			
			$descurl ='';/*嘉宾介绍链接*/
			$classid='';/*关联列表id*/
			$showdesc = 1;

			$historydesc = '';
			$showhistory = 0;	
			$corpdesc = '';
		    $showcorp =0;

			/*获取用户信息*/
			if($userid)
			{
				$userdetail=Rs_user::model()->findByPk($userid);
				$descurl =$userdetail->user_descurl;
				$classid.=$userdetail->classid.',';
			}

			/*获取主持人信息*/
			if($userid)
			{
				$userdetail=Rs_user::model()->findByPk($admin);
				$classid.=$userdetail->classid;
			}
 		/*类别id、嘉宾介绍链接、历史记录，公司介绍，兼容原先所以保留该字段*/





					$model = new Rs_show();
					$ret =  $model->modShow($id,$topic,$starttime,$endtime,$showip,$descurl,$memo,$onlinenum1,$onlinenum2,$corpdesc,$procdesc,$historydesc,$showcorp,$showproc,$showhistory,$topicpic,$showdesc,$channlename,$channlelink,$userid,$player_num,$showplayer,$admin);
					
					PublicAction::addtocache("$id._info_mod", time(),'roadshow_');
					   if($ret)
					   {
						   /*写日志*/	
							$param = array(
							'mid'=>77,//在云平台上的模块id
							'gid'=>3,//在云平台上的功能id
							'type'=>2,//操作类型
							'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Show/Showlist'),//操作地址
							'node'=>'路演管理-修改',//操作说明
							);
							$r = CloudIdentify::addLog($param);//写入日志	
						   //$obj->errorno = '1000';
							//$obj->error = '修改成功!';
                       }/*else 
					   {   
							$obj->errorno = '1001';
							$obj->error = '修改失败!';
                       }*/
					 $obj->errorno = '1000';
					 $obj->error = '修改成功!';
				if(!empty($classid)){
					Rs_show_class::model()->Delshowclass($id);
						$ids=  explode( ',',$classid);
						    foreach ($ids as $showid) {
						    	if(is_numeric($showid)){
						    	Rs_show_class::model()->addShowclass($id,$showid,$addtime);
						     }
						    }		
						}

			/*兼容*/
			$userid=$userid.','.$admin;
						
			if(!empty($userid)){
				Rs_show_user::model()->Delshowuser($id);
				        $i = 0;
						$m=  explode( ',',$userid);
							    foreach ($m as $n) {						    	
							    	if(is_numeric($n)){
								    	$ret = Rs_user::model()->checkuserisadmin($n);									    
							           }
							           if($ret[0]['isadmin'] == 1)	{
										    $i++;
										    } 							           				           
							        }
							        if($i>=1){
	                                      foreach ($m as $uid) {
		                                      	if(is_numeric($uid)){
									    	            $ret = Rs_user::model()->checkuserisadmin($uid);
		                                      	}
							                    Rs_show_user::model()->addShowuser($id,$ret[0]['cid'],$uid);
	                                         }
							           }else{
							           	$obj->errorno = '1001';
							           	$obj->error = '所邀请的嘉宾中必须包含一位主持人!';
							           }	         
					}
//					
					echo json_encode ( $obj );
			}
	
			
		public function actionShowclasslist(){
			$this->layout = "//layouts/column3";
			/*判断权限*/
			$add = $edit = $del = true;
			$ModID = Yii::app()->params['Permission']['show']['module'];//模块ID
			$AddID = Yii::app()->params['Permission']['show']['Addshow'];//添加功能
			$EditID = Yii::app()->params['Permission']['show']['Saveshow'];//编辑功能
			$DelID = Yii::app()->params['Permission']['show']['Delshow'];//删除功能
			
			$_msg = CloudIdentify::checkAction($ModID,array($AddID,$EditID,$DelID));//检验用户是否有权
			$all = $_msg[0];//所有的错误代码
			if($all[0]!=1){//没有权限  添加
				$add = false;
			}
			if($all[1]!=1){//没有权限  修改
				$edit = false;
			}
			if($all[2]!=1){//没有权限  删除
				$del = false;
			}
	            $params = (isset($_GET)&& !empty($_GET))?$_GET:'';//搜索参数
		        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;//初始值
				$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : Yii::app()->params['postsPerPage'];
		        $show = new Rs_show_class();
		        $data = $show->showList($params,$page,$pagesize);
		        $showclass = new Rs_class();
	            $classlist =$showclass->getclasslist();
	            $user = new Rs_user();
	            $userlist =$user->getuserlist();
	            $sign = 1;
		        $this->render('LuyList',array(
	                                    'count'=>$data['count'],
	                                    'showList'=>$data['list'],
		                                'classlist'=>$classlist,
		                                'userlist'=>$userlist,
	                                    'pages'=>$data['pager'],
									    'pagesize'=>$pagesize,
									    'currentPage'=>$page,
								        'edit'=>$edit,
								        'del'=>$del, 
		                                'sign'=>$sign
	                          ));  
	                          
			}
/*description:信息详情展示
	 * */
	public function actionLookInfo(){
		$this->layout = "//layouts/column3";
			$id = '';
			if(isset($_GET["id"])&& $_GET["id"]){
				$id = $_GET["id"];
			}
			$cid=1;
			if(isset($_GET["cid"])&& $_GET["cid"]){
				$cid = $_GET["cid"];
			}
			$this->loadModel($id);
			$info = Rs_show::model()->getInfoById($id,1);
			$showclass = new Rs_class();
	        $classlist =$showclass->getclasslist();
	        $user = new Rs_user();
	        $userlist =$user->getuserlist($cid);   
	         if ($id) {	
				$showMsg = Rs_show::model ()->findByPk($id);
				if ($showMsg) {
					$content = array (
					$showMsg->id, 
					$showMsg->topic, 
					$showMsg->topicpic,
					$showMsg->starttime,
					$showMsg->endtime,
					$showMsg->showip,
					$showMsg->descurl,
					$showMsg->showdesc,
					$showMsg->historydesc,
					$showMsg->showhistory,
					$showMsg->corpdesc,
					$showMsg->showcorp,
					$showMsg->procdesc,
					$showMsg->showproc,
					$showMsg->channlename,
					
					$showMsg->channlelink,
					$showMsg->onlinenum1,
					$showMsg->onlinenum2,
					$showMsg->memo,
					$showMsg->hits,
					$showMsg->player_num,
					$showMsg->userid,
					$showMsg->showplayer,
					$showMsg->admin,
					);
					
				} 
			}
			$this->render('XsMor',array(
									 'userlist'=>$userlist,
			                         'class'=>$class,
			                         'user'=>$user,
			                         'content'=>$content));
	}
	
		public function loadModel($id)
			{
				$model= Rs_show::model()->findByPk($id);
				if($model===null)
					throw new CHttpException(404,'请求的页面不存在，请重试！');
				return $model;
			}
}