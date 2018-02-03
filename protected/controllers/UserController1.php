<?php

class UserController extends Controller
{
	public $layout='//layouts/column2';
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function actionUploadImg(){
		$conn = Yii::app()->db2; //获取数据库连接对象;
		$this->layout = "//layouts/column3";
//			error_reporting(0);
			//header("Content-type:text/html; Charset=utf-8");
			//if($_GET['act'] == 'upload'){
		    $images = new Images1("file");
			//}
			$path = $_POST['path'];
			
			if ($_GET['act'] == 'cut'){	
				//var_dump($_FILES['file']);exit;
				$path_arr = explode("//",$path);
				$path1 = explode('/',$path_arr[1]);
				unset($path1[0]);
				$strs = implode('/',$path1);
				$image = "/home/httpd/cloud_computing_center/roadShow.cloud.cnfol.com/".$strs;
				$res = $images->thumb($image,false,1);
				if($res == false){
					echo "裁剪失败";
				}elseif(is_array($res)){
					$res['big'] = "http://roadshow.cnfol.com/images/".date('Ym').'/'.basename($res['big']);
					$res['small'] =  "http://roadshow.cnfol.com/images/".date('Ym').'/'.basename($res['small']);
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
				$path = "http://roadshow.cnfol.com/images/".date('Ym')."/".basename($path) ;

			}
		}
			$this->render('imgUp',array('path'=>$path));
	}
	public function actionUserlist(){
			$this->layout = "//layouts/column3";
			
	/*判断权限*/
		$add = $edit = $del  = true;
		$ModID = Yii::app()->params['Permission']['user']['module'];//模块ID
		$AddID = Yii::app()->params['Permission']['user']['Adduser'];//添加功能
		$EditID = Yii::app()->params['Permission']['user']['SaveUser'];//编辑功能
		$DelID = Yii::app()->params['Permission']['user']['Deluser'];//删除功能
		
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
	        $user = new Rs_user();
	        $data = $user->userList($params,$page,$pagesize);
	        $corp = new Rs_corp();
	        $corplist =$corp->getcorplist();
			
			/*写日志*/	
			$param = array(
			'mid'=>50,//在云平台上的模块id
			'gid'=>1,//在云平台上的功能id
			'type'=>4,//操作类型
			'url'=>'http://roadshow.cnfol.com'.yii::app()->createUrl('User/Userlist'),//操作地址
			'node'=>'嘉宾管理-搜索',//操作说明
			);
			$r = CloudIdentify::addLog($param);//写入日志	
			
	        $this->render('LuyCustList',array(
                                    'count'=>$data['count'],
                                    'userList'=>$data['list'],
                                    'pages'=>$data['pager'],
	                                'corplist'=>$corplist,
								    'pagesize'=>$pagesize,
								    'currentPage'=>$page,
	        						'add'=>$add,
								    'edit'=>$edit,
								    'del'=>$del,   
                          ));  
                          
		}
		
     /*auther by yuexl
	 * date 2012-7-6
	 * description:添加嘉宾
	 */
	public function actionAdduser(){
		$obj = new stdClass();
		$request = Yii::app()->getRequest();
		$user = new Rs_user();
		
	    $username = trim ( $request->getPost ( "username" ) );	
	    $sex = trim ( $request->getPost ( "sex" ) );	
	    $password = md5(trim ( $request->getPost ( "password" ) ));	
	    $userdesc = trim ( $request->getPost ( "userdesc" ) );	
	    $isadmin = trim ( $request->getPost ( "isadmin" ) );	
	    $cid = trim ( $request->getPost ( "cid" ) );	
	    $userid = trim ( $request->getPost ( "userid" ) );	
	    $user_name = trim ( $request->getPost ( "user_name" ) );	
	    $nick_name = trim ( $request->getPost ( "nick_name" ) );
	    $head_photo = trim ( $request->getPost ( "imgpath" ) );
 		$user_column = trim ( $request->getPost ( "zhuanlan" ) );	
	    $addtime = time();

			$ret = $user->addUser($username,$sex,$password,$userdesc,$isadmin,$cid,$userid,$user_name,$nick_name,$addtime,$head_photo,$user_column);
			 /*写日志*/	
			$param = array(
			'mid'=>50,//在云平台上的模块id
			'gid'=>1,//在云平台上的功能id
			'type'=>1,//操作类型
			'url'=>'http://roadshow.cnfol.com'.yii::app()->createUrl('User/Adduser'),//操作地址
			'node'=>'嘉宾管理-添加嘉宾',//操作说明
			);
			$r = CloudIdentify::addLog($param);//写入日志	
			if($ret){
				$obj->errorno = '1000';
				$obj->error = '添加成功!';
			}else{
				$obj->errorno = '1001';
				$obj->error = '添加失败!';
			}
			echo json_encode ( $obj );
	
	}
     /*auther by yuexl
	 * date 2012-7-6
	 * description:获取指定的嘉宾信息
	 */
	public function actionGetusermsg(){
	   $obj = new stdClass ();
		$userMsg = $userDetail = array ();
		$request = Yii::app ()->getRequest ();
		if ($request->getPost ( "Id" )) {	
			$userMsg = Rs_user::model ()->findByPk($request->getPost ( "Id" ));
			if ($userMsg) {
				$userDetail = array (
				$userMsg->id,
				$userMsg->username ,
				$userMsg->sex, 
				$userMsg->password, 				 
				$userMsg->userdesc,
				$userMsg->isadmin, 
				$userMsg->cid, 
				$userMsg->userid, 
				$userMsg->user_name,
				$userMsg->nick_name,
				$userMsg->head_photo,
				$userMsg->user_column,
				);
				$obj->errorno = '000';
				$obj->content = implode ( '|', $userDetail );
			} else {
				$obj->errorno = '001';
				$obj->content = '参数错误';
			}
		}
		echo json_encode ( $obj );
	}

	/*auther by yuexl
	 * date 2012-7-9
	 * description:保存修改的嘉宾信息
	 * */
	public function actionSaveUser(){
	    $obj = new stdClass ();
			$request = Yii::app ()->getRequest ();
			$id = $request->getPost ( "aid" );
			$username = trim ( $request->getPost ( "eusername" ) );	
	        $sex = trim ( $request->getPost ( "asex" ) );	
		    $password = md5(trim ( $request->getPost ( "apassword" ) ));	
		    $userdesc = trim ( $request->getPost ( "auserdesc" ) );	
		    $isadmin = trim ( $request->getPost ( "aisadmin" ) );	
		    $cid = trim ( $request->getPost ( "acid" ) );	
		    $userid = trim ( $request->getPost ( "auserid" ) );	
		    $user_name = trim ( $request->getPost ( "auser_name" ) );	
		    $nick_name = trim ( $request->getPost ( "anick_name" ) );	
		    $addtime = time();
 			$head_photo = trim ( $request->getPost ( "imgpath" ) );
 			$user_column = trim ( $request->getPost ( "zhuanlan" ) );
			$model = new Rs_user();
			$ret = $model->modUser($id,$username,$sex,$password,$userdesc,$isadmin,$cid,$userid,$user_name,$nick_name,$addtime,$head_photo,$user_column);
		     $IDS = Rs_show_user::model()->getSidArr($id);//将嘉宾信息置入memecache中
					 if(!empty($IDS)){//有值
					 	$total = count($IDS);
					 	for($i=0;$i<$total;$i++){
					 		PublicAction::addtocache($IDS[$i]."_info_mod", time(),'roadshow_');//写入缓存
					 	}
					 }
			if($ret){
			/*写日志*/	
			$param = array(
			'mid'=>50,//在云平台上的模块id
			'gid'=>3,//在云平台上的功能id
			'type'=>2,//操作类型
			'url'=>'http://roadshow.cnfol.com'.yii::app()->createUrl('User/SaveUser'),//操作地址
			'node'=>'嘉宾管理-修改嘉宾',//操作说明
			);
			$r = CloudIdentify::addLog($param);//写入日志	
			    $obj->errorno = '1000';
			    $obj->error = '修改成功!';
			}else{
				$obj->errorno = '1001';
				$obj->error = '修改失败!';
			}
			echo json_encode ( $obj );
	}
	
/*desciption:验证公司名称是否已经存在
	 * @params   $name 公司名称  字符串
	 * */
	public function actioncheckisexist(){
		$re = Rs_user::model()->checkNameIsExist( Yii::app()->getRequest()->getPost("Name"),Yii::app()->getRequest()->getPost("ID") );
		if( $re ){
			$msg = '该嘉宾已存在';
			$errorno = '405';
		}else{
			$msg = '';
			$errorno = '000';
		}
		echo json_encode(array('errorno'=>$errorno,'msg'=>$msg));
	}
    /*auther by yuexl
	 * date 2012-7-6
	 * description:删除嘉宾
	 */
    public function actionDeluser(){
			$id = Yii::app()->getRequest()->getPost("id");/*要删除的记录ID*/
			$ids=  explode( ',',$id);
		    foreach ($ids as $userid) {
		    	if(is_numeric($userid)){
		    	$model = Rs_user::model()->findByPk($userid);
				$return = $model->Deluser($userid);
		     }
		    }

			if( $return ){
				/*写日志*/	
				$param = array(
				'mid'=>50,//在云平台上的模块id
				'gid'=>2,//在云平台上的功能id
				'type'=>3,//操作类型
				'url'=>'http://roadshow.cnfol.com'.yii::app()->createUrl('User/Deluser'),//操作地址
				'node'=>'嘉宾管理-删除嘉宾',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				$result = array('errorno'=>'000','msg'=>'');
			}else{
				$result = array('errorno'=>'405','msg'=>'删除失败,请重试!');
			}
			echo json_encode($result);
	}
	
}