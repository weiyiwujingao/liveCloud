<?php
header("Content-type: text/html; charset=utf-8"); 
class InfoController extends Controller
{
	//private $model = array(1=>4,2=>4,3=>4,4=>4,5=>4,6=>4);
	private $model = array(1=>2632,2=>2633,3=>2634,4=>2635,5=>2636,6=>2637,7=>2638,8=>77);
	private $model_name = array(1=>'黄金',2=>'期货',3=>'股票',4=>'保险',5=>'基金',6=>'外汇',7=>'证券',8=>77,9=>'出国');
	/*状态对应字段*/
	private $status=array(0=>'未审核',1=>'已审核',2=>'已发布',3=>'审核不通过',-1=>'删除未审核',-2=>'删除已审核',-3=>'删除已发布',-4=>'删除审核不通过');
	public function actionIndex()
	{
		$this->render('index');
	}


	/*输入链接 进入路演*/
	public function actionIntoclass()
	{
		$this->layout = "//layouts/column3";	
		  /*判断权限*/
		$this->render('into');
	}


	/*
		问题审核
		style 1：问题审核2：问题发布管理3：垃圾箱
	*/	
    public function actionInfoclass()
	{
		
		$this->layout = "//layouts/column3";	
	
		$sid=$_GET['sid'];//路演id
		$style=isset($_GET['style'])?$_GET['style']:1;//1：问题审核页面2：发布管理页面
		$userlist=array();//用户列表

		if(empty($sid))
		{
			echo '请输入嘉宾ＩＤ或者嘉宾名字';
			exit;
		}

		/*获取最新的列表id*/
		$rs_show = new Rs_show();
		$rs = $rs_show->find(array('select'=>array('id,topic,userid,admin'),'condition'=>'id = '. $sid,'order'=> 'id desc'));
		$topic=$rs->topic;//路演主题
		$id=$rs->userid;//用户id
		$admin=$rs->admin;

		$rs='';
		/*获取所属类别*/
		if(is_numeric($id)){
			$rs=Rs_user::model()->find(array('select'=>array('classid,id,username'),'condition'=>'id = '. $id));
		}

		if(is_numeric($admin)){
			$adminall=Rs_user::model()->find(array('select'=>array('id,username'),'condition'=>'id = '. $admin));
		}
		$adminname=$adminall->username;


		
		/*$cid类别,userid 用户id，username用户名称*/
		if($rs)
		{
			$rs_c=Rs_class::model()->find(array('select'=>array('quotation'),'condition'=>'id = '. $rs->classid));
			$cid=$rs_c->quotation;$userid=$rs->id;$username=$rs->username;
		}

		/*获取用户列表*/
		if($style==2)
		{
			$this->status[1]='未发布';
			$user = new Rs_user();
	        $userlist =$user->getuserlist();
		}

		if($style==1)
		{
			$this->status[2]='已审核';
		}
		/*获取用户列表*/

		
	if(!empty($cid))
	{
		/*显示类别名称*/
		$type_name=$this->model_name[$cid];

		/*判断是否有该类别的权限*/
		$Gold2 = $this->model[$cid];//产看是否有该路演的权限
	}

     /*判断权限*/
		$add = $mod = $del = $speak = true;
		$ModID = Yii::app()->params['Permission']['info']['module'];//模块ID
		$ExamineID = Yii::app()->params['Permission']['info']['Examine'];//添加功能
		$DelID = Yii::app()->params['Permission']['info']['Del'];//删除功能 	
		$SpeakID = Yii::app()->params['Permission']['info']['Speak'];//回复和修改权限


		if(!empty($Gold2))
		{
			$ModID=$Gold2;
		}
		if(empty($type_name))
		{
			$type_name='';
		}

		
		
		$_msg = CloudIdentify::checkAction($ModID,array($ExamineID,$DelID,$SpeakID));//检验用户是否有权

		$all = $_msg[0];//所有的错误代码
		if($all[0]!=1)
		{//没有权限 审核
			$mod= false;
		}
		if($all[1]!=1){//没有权限  删除
			$del = false;
		}
		if($all[2]!=1){//没有权限  删除
			$speak = false;
		}
		
		


		$params = (isset($_GET)&& !empty($_GET))?$_GET:'';//搜索参数
		$params['username']=$username;
		$params['topic']=$topic;
		$params['style']=$style;
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;//初始值
		$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : Yii::app()->params['postsPerPage'];
		$rs_info = new Rs_info();
		$data=$rs_info->showinfoList($params,$page,$pagesize);
	
	

		$view='LuInfoList_'.$style;
		
		$this->render($view,array(
									'sid'=>$sid,	
									'params'=>$params,
									'status'=>$this->status,
									'count'=>$data['total'],
									'pages'=>$data['pager'],
									'infoList'=>$data['list'],
									'pagesize'=>$pagesize,
									'currentPage'=>$page,
									'mod'=>$mod,
									'del'=>$del,
									'speak'=>$speak,
									'userlist'=>$userlist,
									'adminname'=>$adminname,
									'admin'=>$admin,
									'type_name'=>$type_name,
									 ));

		}

		/*删除 审核 发布 记录*/
		public function actionexamineordel()
		{

				/*获取参数*/
				$id = Yii::app()->getRequest()->getPost("id");//问题id
				$type = Yii::app()->getRequest()->getPost("type");//删除或修改
				$sid = Yii::app()->getRequest()->getPost("sid");//路演id
				$pasrdo = Yii::app()->getRequest()->getPost("pasrdo");//审核通过或不通过


			


				
				if(empty($id)||!is_numeric($type)||empty($sid))
				{
					$result = array('errorno'=>'002','msg'=>'参数错误!');
					echo json_encode($result);
					exit;
				}
				
				
				if(empty($pasrdo))
				{
					$pasrdo=1;
				}
				

				/*权限判断*/
				$add = $mod = $del  = false;
				$ModID = Yii::app()->params['Permission']['info']['module'];//模块ID
				$ExamineID = Yii::app()->params['Permission']['info']['Examine'];//添加功能
				$DelID = Yii::app()->params['Permission']['info']['Del'];//删除功能 	
				$_msg = CloudIdentify::checkAction($ModID,array($ExamineID,$DelID));//检验用户是否有权

				$all = $_msg[0];//所有的错误代码
				if($all[0]!=1){//没有权限 审核
					$mod= true;
				}

				if($all[1]!=1){//没有权限  删除
					$del = true;
				}
				if(($type==1&&$mod)||($type==2&&$del))
				{
					$result = array('errorno'=>'001','msg'=>'没有权限!');
					echo json_encode($result);
					exit;
				}
				
				/*做删除和审核操作*/
				$rs_info = new Rs_info();
				$rs=$rs_info->modordel($id,$type,$sid,$pasrdo);

				$result = array('errorno'=>'000','msg'=>'操作成功!');
				echo json_encode($result);
				exit;
				
		}

		/*添加问题*/
		public function actionaddquestion()
		{
				/*权限判断*/
				$add = $mod = $del  = true;
				$ModID = Yii::app()->params['Permission']['info']['module'];//模块ID
				$SpeakID = Yii::app()->params['Permission']['info']['Speak'];//添加功能	
				$_msg = CloudIdentify::checkAction($ModID,array($SpeakID));//检验用户是否有权

				$all = $_msg[0];//所有的错误代码
				if($all[0]!=1){//没有权限 审核
					echo '没有发言权限';
					exit;
				}
				
				$sid=isset($_GET['sid'])?$_GET['sid']:'';
				$type=isset($_GET['type'])?$_GET['type']:'';
				$id=isset($_GET['id'])?$_GET['id']:'';
				$content=trim(Yii::app()->getRequest()->getPost("content"));
				$asker=trim(Yii::app()->getRequest()->getPost("askers"));
				$status=trim(Yii::app()->getRequest()->getPost("SET_VALUE"));
				
				

				
				

				if(!is_numeric($sid)||!is_numeric($type)||empty($content)||empty($asker))
				{
					echo '参数错误';
					exit;
				}
	
				
				/*图片上传文件*/
				$imgfile=$_FILES;
				$images = new Images1("file");//建立图片上传类
				$imageurl='';//保存图片删除文件
				if(!empty($imgfile))
				{
					foreach($imgfile as $key=>$val)
					{	
						if(empty($val['name']))continue;//没有文件时候跳过
						$images->inputName=$key;//查看是上传那个文件
						$path = $images->move_uploaded();
						$path = str_replace('//', '/', $path);
						$images->thumb($path,false,0);//文件比规定的尺寸大则生成缩略图，小则保持原样

						if($path == false)
						{
							$images->get_errMsg();
							exit;
						}else{				
							$path = "http://roadshow.cnfol.com/images/".date('Ym')."/".basename($path) ;
							$imageurl.=$path.',';
						}
					}
					$imageurl=rtrim($imageurl,',');
				}
			/*图片上传文件*/
			
		
			/*做删除和审核操作*/
			$rs_info = new Rs_info();
			
			$rs=$rs_info->question($sid,$type,$imageurl,$asker,$content,$id,$status);

			/*成功回复上一个页面*/
			echo '<script>alert("操作成功!");</script>';
			echo '<script>self.location="/?g=aW5mby9JbmZvY2xhc3M%3D&sid='.$sid.'&style=2"</script>';				
		}

}