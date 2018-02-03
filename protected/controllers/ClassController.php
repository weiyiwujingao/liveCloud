<?php

class ClassController extends Controller
{
	private $advertising=array(1=>'黄金路演广告',2=>'期货路演广告');
	private $hangqing=array(1=>'黄金行情',2=>'期货行情',3=>'股票行情',4=>'保险行情',5=>'基金行情',6=>'外汇行情',7=>'证券行情',9=>'出国行情',10=>'原油行情',11=>'邮币卡行情',12=>'私募行情');
	
	
     public function actionShowclass()
	{
		 
		$this->layout = "//layouts/column3";	
			
     /*判断权限*/
		$add = $edit = $del  = true;
		$ModID = Yii::app()->params['Permission']['class']['module'];//模块ID
		$AddID = Yii::app()->params['Permission']['class']['Addshowclass'];//添加功能
		$EditID = Yii::app()->params['Permission']['class']['SaveClass'];//编辑功能
		$DelID = Yii::app()->params['Permission']['class']['Delclass'];//删除功能
		     	
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
	        $showclass = new Rs_class();
	        $data = $showclass->showclassList($params,$page,$pagesize);
			
			//isset($_GET)&& !empty($_GET)
	        if(count($params)>1){
				 /*写日志*/	
				$param = array(
				'mid'=>79,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>4,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Class/Showclass'),//操作地址
				'node'=>'分类管理-搜索',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			}

			/*获取频道列表*/
			$rs=file_get_contents('http://shell.cnfol.com/category/cat.dat');
			$rs=unserialize($rs);
			/*获取频道列表*/
			/* 单独添加公转私频道 */
			if(!empty($rs))
		    {
				$rs[] = array("id"=>'3774',"name"=>'私募测试专用',"parentid"=>'1',"domain"=>'http://simu.test.cnfol.com',"enname"=>'simutest');
				$rs[] = array("id"=>'3813',"name"=>'公转私',"parentid"=>'3774',"domain"=>'',"enname"=>'gongzhuansi');
		    }

	        $this->render('LuytypeList',array(
								        'count'=>$data['total'],
	                                    'pages'=>$data['pager'],
								        'classList'=>$data['list'],
								        'pagesize'=>$pagesize,
								        'currentPage'=>$page,
		        						'add'=>$add,
								        'edit'=>$edit,
								        'del'=>$del, 
										'advertising'=>$this->advertising,
										'hangqing'=>$this->hangqing,
										'rs'=>$rs,
	                                     ));
		}
		
	    /*desciption:验证分类名称是否已经存在
		 * @params   $name 公司名称  字符串
		 * */
		public function actioncheckisexist(){
			$re = Rs_class::model()->checkClassNameIsExist( Yii::app()->getRequest()->getPost("Name") );
			if( $re ){
				$msg = '该名称已存在';
				$errorno = '405';
			}else{
				$msg = '';
				$errorno = '000';
			}
			echo json_encode(array('errorno'=>$errorno,'msg'=>$msg));
		}
		
		
		public function actionAddshowclass(){
			$obj = new stdClass ();
			$request = Yii::app ()->getRequest ();
			
			$classname = trim ( $request->getPost ( "classname" ) );
			$memo = trim ( $request->getPost ( "classmemo" ) );
			$column_id = trim ( $request->getPost ( "column_id" ) );
			$channel_id = trim ( $request->getPost ( "channel_id" ) );
			$column_id_1 = trim ( $request->getPost ( "column_id_1" ) );
			$channel_id_1 = trim ( $request->getPost ( "channel_id_1" ) );
			$column_id_2 = trim ( $request->getPost ( "column_id_2" ) );
			$channel_id_2 = trim ( $request->getPost ( "channel_id_2" ) );
			$class_logo = trim ( $request->getPost ( "class_logo" ) );
			$navigation = trim ( $request->getPost ( "navigation" ) );
			$advertising = trim ( $request->getPost ( "advertising" ) );
			$quotation = trim ( $request->getPost ( "quotation" ) );
			$isshow = trim ( $request->getPost ( "isshow" ) );	
			$addtime = time();


			/*判断参数是否正确*/
			if(empty($classname)||$meno)
			{	
				$obj->errorno = '1001';
				$obj->error = '参数错误!';
				echo json_encode ( $obj );
				exit;
			}

			$model = new Rs_class();
			$ret = $model->addClass($classname,$memo,$addtime,$column_id,$channel_id,$class_logo,$navigation,$advertising,$quotation,$isshow,$column_id_1,$channel_id_1,$column_id_2,$channel_id_2);
			if($ret){
			 /*写日志*/	
				$param = array(
				'mid'=>79,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>1,//操作类型
				'url'=>'http://roadshowtest.cloud.cnfol.com'.yii::app()->createUrl('Class/Showclass'),//操作地址
				'node'=>'分类管理-添加',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				$obj->errorno = '1000';
				$obj->error = '添加成功!';
			}else{
				$obj->error = '添加失败!';
			}
			echo json_encode ( $obj );
		}
		
		
		public function actionDelclass(){
		$id = Yii::app()->getRequest()->getPost("id");/*要删除的记录ID*/
		$ids=  explode( ',',$id);
		$signs=array();
	    foreach ($ids as $class_id) {
	    
	    	if(is_numeric($class_id)){
	    	$model = Rs_class::model()->findByPk($class_id);
			$return = $model->Delclass($class_id);
	     }
	    }
		if( $return ){
		       /*写日志*/	
				$param = array(
				'mid'=>79,//在云平台上的模块id
				'gid'=>2,//在云平台上的功能id
				'type'=>3,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Class/Showclass'),//操作地址
				'node'=>'分类管理-删除',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			$result = array('errorno'=>'000','msg'=>'');
		}else{
			$result = array('errorno'=>'405','msg'=>'删除失败,请重试!');
		}
		echo json_encode($result);
		}
		
		/*auther by yuexl
	 * date 2012-7-6
	 * description:获取指定的公司信息
	 */
	public function actionGetclassmsg(){
	    $obj = new stdClass ();
		$classMsg = $classDetail = array ();
		$request = Yii::app ()->getRequest ();
		if ($request->getPost ( "Id" )) {	
			$classMsg = Rs_class::model ()->findByPk($request->getPost ( "Id" ));	
			if ($classMsg) {
				$classDetail = array (
				$classMsg->id, 
				$classMsg->classname, 
				$classMsg->memo,
				$classMsg->column_id,
				$classMsg->channel_id,
				$classMsg->class_logo,
				$classMsg->navigation,
				$classMsg->advertising,
				$classMsg->quotation,
				$classMsg->isshow,
				$classMsg->column_id_1,
				$classMsg->channel_id_1,
				$classMsg->column_id_2,
				$classMsg->channel_id_2,

				);
				$obj->errorno = '000';
				$obj->content = implode ( '|', $classDetail );
			} else {
				$obj->errorno = '001';
				$obj->content = '参数错误';
			}
		}
		echo json_encode ( $obj );
	}
	
	/*auther by yuexl
	 * date 2012-7-9
	 * description:保存修改的公司信息
	 * */
	public function actionSaveClass(){
	
	        $obj = new stdClass ();
			$request = Yii::app ()->getRequest ();
			$id = $request->getPost ( "aid" );
			
			$classname = trim ( $request->getPost ( "classname" ) );
			$memo = trim ( $request->getPost ( "memo" ) );
			$column_id = trim ( $request->getPost ( "column_id" ) );
			$channel_id = trim ( $request->getPost ( "channel_id" ) );
			$column_id_1 = trim ( $request->getPost ( "column_id_1" ) );
			$channel_id_1 = trim ( $request->getPost ( "channel_id_1" ) );
			$column_id_2 = trim ( $request->getPost ( "column_id_2" ) );
			$channel_id_2 = trim ( $request->getPost ( "channel_id_2" ) );
			$class_logo = trim ( $request->getPost ( "class_logo" ) );
			$navigation = trim ( $request->getPost ( "navigation" ) );
			$advertising = trim ( $request->getPost ( "advertising" ) );
			$quotation = trim ( $request->getPost ( "quotation" ) );
			$isshow = trim ( $request->getPost ( "isshow" ) );	
			$addtime = time();

			$model = new Rs_class();
			$count = $model->checkClassNameIsExist($classname,$id);
			if($count == 1 || $count == 0){
			    $model->modClass($id,$classname,$memo,$column_id,$channel_id,$class_logo,$navigation,$advertising,$quotation,$isshow,$column_id_1,$channel_id_1,$column_id_2,$channel_id_2);
			$obj->errorno = '1000';
			$obj->error = '修改成功!';
			 /*写日志*/	
				$param = array(
				'mid'=>79,//在云平台上的模块id
				'gid'=>3,//在云平台上的功能id
				'type'=>2,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Class/Showclass'),//操作地址
				'node'=>'分类管理-修改',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			}else if($count > 1){
				$obj->error = '该公司名称已存在!';
			}else{
				$obj->error = '修改失败!';
			}
			echo json_encode ( $obj );
	}
	
		
		
}