<?php

class CorpController extends Controller
{
	public $layout='//layouts/column2';
	
//	public function actionIndex()
//	{
////		$this->layout = '//layouts/column2';
//		$this->render('Back01');
//	}
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
	
	
	/*description:获取符合条件的公司列表
	 * 
	 * */
	public function actionCorplist(){
		    $this->layout = "//layouts/column3";
		    
	/*判断权限*/
		$add = $edit = $del = true;
		$ModID = Yii::app()->params['Permission']['corp']['module'];//模块ID
		$AddID = Yii::app()->params['Permission']['corp']['Addcorp'];//添加功能
		$EditID = Yii::app()->params['Permission']['corp']['SaveCorp'];//编辑功能
		$DelID = Yii::app()->params['Permission']['corp']['Delcorp'];//删除功能
		
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
	        $corp = new Rs_corp();
	        $data = $corp->corpList($params,$page,$pagesize);
			//isset($_GET)&& !empty($_GET)
			if(count($params)>1){
			    /*写日志*/	
				$param = array(
				'mid'=>73,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>4,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Corp/Corplist'),//操作地址
				'node'=>'公司管理-搜索',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			}	
            $this->render('corpList',array(
                                    'count'=>$data['count'],
                                    'corpList'=>$data['list'],
                                    'pages'=>$data['pager'],
								    'pagesize'=>$pagesize,
								    'currentPage'=>$page ,
                                    'add'=>$add,
							        'edit'=>$edit,
							        'del'=>$del, 
                          ));
	}
	
    /*desciption:验证公司名称是否已经存在
	 * @params   $name 公司名称  字符串
	 * */
	public function actioncheckisexist(){
		$re = Rs_corp::model()->checkCorpNameIsExist( Yii::app()->getRequest()->getPost("Name") );
		if( $re ){
			$msg = '该公司已存在';
			$errorno = '405';
		}else{
			$msg = '';
			$errorno = '000';
		}
		echo json_encode(array('errorno'=>$errorno,'msg'=>$msg));
	}
	/*auther by yuexl
	 * date 2012-7-6
	 * description:添加公司
	 */
	public function actionAddcorp(){
		    $obj = new stdClass ();
			$request = Yii::app ()->getRequest ();
			$corpname = trim ( $request->getPost ( "Corp_name" ) );
			$corpdesc = trim ( $request->getPost ( "Corp_desc" ) );
			$addtime = time();

			$model = new Rs_corp();
			$ret = $model->addCorp($corpname,$corpdesc,$addtime);
			if($ret){
			    /*写日志*/	
				$param = array(
				'mid'=>73,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>1,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Corp/Corplist'),//操作地址
				'node'=>'公司管理-添加',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			$obj->errorno = '1000';
			$obj->error = '添加成功!';
			}else{
				$obj->error = '添加失败!';
			}
			echo json_encode ( $obj );
	}
	
	/*auther by yuexl
	 * date 2012-7-6
	 * description:获取指定的公司信息
	 */
	public function actionGetcorpmsg(){
	    $obj = new stdClass ();
		$corpMsg = $corpDetail = array ();
		$request = Yii::app ()->getRequest ();
		if ($request->getPost ( "Id" )) {	
			$corpMsg = Rs_corp::model ()->findByPk($request->getPost ( "Id" ));
			if ($corpMsg) {
				$corpDetail = array (
				$corpMsg->id, 
				$corpMsg->corpname, 
				$corpMsg->corpdesc
				);
				$obj->errorno = '000';
				$obj->content = implode ( '|', $corpDetail );
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
	public function actionSaveCorp(){
	        $obj = new stdClass ();
			$request = Yii::app ()->getRequest ();
			$id = $request->getPost ( "aid" );
			$corpname = trim ( $request->getPost ( "acorpname" ) );
			$corpdesc = trim ( $request->getPost ( "acorpdesc" ) );
			$addtime = time();

			$model = new Rs_corp();
			$count = $model->checkCorpNameIsExist($corpname);
			if($count == 1 || $count == 0){
			    $model->modCorp($id,$corpname,$corpdesc,$addtime);
			    $obj->errorno = '1000';
			    $obj->error = '修改成功!';
				 /*写日志*/	
				$param = array(
				'mid'=>73,//在云平台上的模块id
				'gid'=>3,//在云平台上的功能id
				'type'=>2,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Corp/Corplist'),//操作地址
				'node'=>'公司管理-修改',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			}else if($count > 1){
				$obj->error = '该公司名称已存在!';
			}else{
				$obj->error = '修改失败!';
			}
			echo json_encode ( $obj );
	}
	
	/*auther by yuexl
	 * date 2012-7-6
	 * description:删除公司
	 */
    public function actionDelcorp(){
        $id = Yii::app()->getRequest()->getPost("id");/*要删除的记录ID*/
		$ids=  explode( ',',$id);
		$signs=array();
	    foreach ($ids as $corp_id) {
	    
	    	if(is_numeric($corp_id)){
	    	$model = Rs_corp::model()->findByPk($corp_id);
			$return = $model->Delcorp($corp_id);
	     }
	    }
		if( $return ){
		       /*写日志*/	
				$param = array(
				'mid'=>73,//在云平台上的模块id
				'gid'=>2,//在云平台上的功能id
				'type'=>3,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Corp/Corplist'),//操作地址
				'node'=>'公司管理-删除',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
			$result = array('errorno'=>'000','msg'=>'');
		}else{
			$result = array('errorno'=>'405','msg'=>'删除失败,请重试!');
		}
		echo json_encode($result);
		}

}