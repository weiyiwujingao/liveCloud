<?php

class UserController extends Controller
{
	public $layout='//layouts/column2';
	public function actionIndex()
	{
		$this->render('index');
	}

	
	public function actionUploadImg(){
		$conn = Yii::app()->db2; //获取数据库连接对象;
		$this->layout = "//layouts/column3";

		    $images = new Images1("file");
	
			$path = $_POST['path'];
			
			if ($_GET['act'] == 'cut'){	
				$path_arr = explode("//",$path);
				$path1 = explode('/',$path_arr[1]);
				unset($path1[0]);
				$strs = implode('/',$path1);
				$image = "/home/httpd/cloud_computing_center/roadShow.cloud.cnfol.com/".$strs;
				$res = $images->thumb($image,false,1);
				if($res == false){
					echo "裁剪失败";
				}elseif(is_array($res)){
					$res['big'] = "http://roadshow.cloud.cnfol.com/images/".date('Ym').'/'.basename($res['big']);
					$res['small'] =  "http://roadshow.cloud.cnfol.com/images/".date('Ym').'/'.basename($res['small']);
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
				$path = "http://roadshow.cloud.cnfol.com/images/".date('Ym')."/".basename($path) ;

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
	        //$classlist =Rs_user_class::model()->getuserclasslist();
			 $showclass = new Rs_class();
	         $classlist =$showclass->getclasslist();
			if(count($params)>1){
				/*写日志*/	
				$param = array(
				'mid'=>75,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>4,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('User/Userlist'),//操作地址
				'node'=>'用户管理-搜索',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志				
			}
			
			
	        $this->render('LuyCustList',array(
                                    'count'=>$data['count'],
                                    'userList'=>$data['list'],
                                    'pages'=>$data['pager'],
	                                'corplist'=>$corplist,
	        						'classlist'=>$classlist,
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
		/*查看是否含有添加权限*/
		$ModID = Yii::app()->params['Permission']['user']['module'];//模块ID
		$AddID = Yii::app()->params['Permission']['user']['Adduser'];//添加功能
		$_msg = CloudIdentify::checkAction($ModID,array($AddID));//检验用户是否有权
		if($_msg[0][0]!=1)
		{//没有权限  添加
				$obj->errorno = '1002';
				$obj->error = '没有添加权限!';
				echo json_encode ( $obj );
				exit;
		}

		/*查看是否含有添加权限*/
	
		
		$request = Yii::app()->getRequest();
		$user = new Rs_user();
		
	    $username = trim ( $request->getPost ( "username" ) );//用户名	
	    $sex = trim ( $request->getPost ( "sex" ) );//性别	
	    $password = md5(trim ( $request->getPost ( "password" ) ));//密码	
	    $userdesc = trim ( $request->getPost ( "userdesc" ) );//用户简介	
	    $isadmin = trim ( $request->getPost ( "isadmin" ) );//是否主持人	
	    $cid = trim ( $request->getPost ( "cid" ) );//公司id	
	    $userid = trim ( $request->getPost ( "userid" ) );//用户id	
	    $user_name = trim ( $request->getPost ( "user_name" ) );//用户名	
	    $nick_name = trim ( $request->getPost ( "nick_name" ) );//昵称
	    $class_id = trim ( $request->getPost ( "classid" ) );//分类id	
		$check = trim ( $request->getPost ( "check" ) );//是否显示
		$head_photo = trim ( $request->getPost ( "imgpath" ) );//头像
 		$user_column = trim ( $request->getPost ( "zhuanlan" ) );//嘉宾专栏	
		$user_descurl = trim ( $request->getPost ( "user_descurl" ) );//用户连接
		$specialty = trim ( $request->getPost ( "specialty" ) );//用户擅长
		
		/*参数过滤*/
		if(empty($username)||empty($password)||empty($user_descurl)||!is_numeric($class_id)||!is_numeric($cid))
		{
				$obj->errorno = '1002';
				$obj->error = '参数错误!';
				echo json_encode ( $obj );
				exit;
		}
		/*参数过滤*/
		
		
		
	    $addtime = time();
			$ret = $user->addUser($username,$sex,$password,$userdesc,$isadmin,$cid,$userid,$user_name,$nick_name,$addtime,$class_id,$check,$head_photo,$user_column,$user_descurl,$specialty);
			if($ret){
			   /*写日志*/	
				$param = array(
				'mid'=>75,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>1,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('User/Userlist'),//操作地址
				'node'=>'用户管理-添加',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
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
				$userMsg->classid,
                $userMsg->ischeck,
				$userMsg->head_photo,
				$userMsg->user_column,
				$userMsg->user_descurl,
				$userMsg->specialty,
				$userMsg->issuperuser,
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
			$username = trim ( $request->getPost ( "eusername" ) );//用户名	
	        $sex = trim ( $request->getPost ( "asex" ) );//性别	
		    $pwd2 = $request->getPost ( "apassword" );	//修改时 缓过来的密码
		    $userdesc = trim ( $request->getPost ( "auserdesc" ) );//简介	
		    $isadmin = trim ( $request->getPost ( "aisadmin" ) );//是否主持人	
		    $cid = trim ( $request->getPost ( "acid" ) );//公司	
			$issuperuser = trim ( $request->getPost ( "asuperuser" ) );//是否为超级用户新添加
		    $userid = trim ( $request->getPost ( "auserid" ) );//用户id	
		    $user_name = trim ( $request->getPost ( "auser_name" ) );//用户名	
		    $nick_name = trim ( $request->getPost ( "anick_name" ) );//昵称
		    $classid = trim ( $request->getPost ( "aclassid" ) );//分类id
            $check = trim ( $request->getPost ( "acheck" ) );//是否显示			
		    $addtime = time();
			$head_photo = trim ( $request->getPost ( "imgpath" ) );//头像
 			$user_column = trim ( $request->getPost ( "zhuanlan" ) );//专栏
			$user_descurl = trim ( $request->getPost ( "user_descurl" ) );//用户url
			$specialty = trim ( $request->getPost ( "specialty" ) );//擅长

		/*参数过滤*/

	
		if(empty($username)||empty($pwd2)||empty($user_descurl)||!is_numeric($classid)||!is_numeric($cid))
		{
				$obj->errorno = '1002';
				$obj->error = '参数错误!';
				echo json_encode ( $obj );
				exit;
		}
		/*参数过滤*/


            $userMsg = Rs_user::model ()->findByPk($id);
            $pwd1 = $userMsg->password;//库中密码
			if($pwd1 == $pwd2){
				$password = $pwd1;
			}else{
				$password = md5(trim($pwd2));
			}
			$model = new Rs_user();
			$ret = $model->modUser($id,$username,$sex,$password,$userdesc,$isadmin,$cid,$issuperuser,$userid,$user_name,$nick_name,$addtime,$classid,$check,$head_photo,$user_column ,$user_descurl,$specialty);
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
				'mid'=>75,//在云平台上的模块id
				'gid'=>3,//在云平台上的功能id
				'type'=>2,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('User/Userlist'),//操作地址
				'node'=>'用户管理-修改',//操作说明
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
				'mid'=>75,//在云平台上的模块id
				'gid'=>2,//在云平台上的功能id
				'type'=>3,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('User/Userlist'),//操作地址
				'node'=>'用户管理-删除',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				$result = array('errorno'=>'000','msg'=>'');
			}else{
				$result = array('errorno'=>'405','msg'=>'删除失败,请重试!');
			}
			echo json_encode($result);
	}
	
}