<?php

class UiController extends Controller
{
	public $layout='//layouts/column1';
	
	/*信息列表
	 * */
	public function actionUiList(){
		$this->layout = "//layouts/column3";
		$ModID = Yii::app()->params['Permission']['ui']['module'];//模块id
		$lj = Yii::app()->params['Permission']['ui']['lj'];//按钮
		$_per = CloudIdentify::checkAction($ModID,$lj);//验证是否有权限访问
		
		if($_per !=1){//没有权限  删除
			$lj = false;
		}else{
			$lj = true;
	    }
		
		$t = $_GET["t"];
		if(isset($_GET["t"])&& $_GET["t"]=="livestockhits"){
			$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : Yii::app()->params['postsPerPage'];//每页显示记录条数
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;//初始值
			$params = array('topic'=>trim($_GET['data']));//搜索参数
			$data = Rs_ui::model()->getPVlist($params,$page,$pagesize,'starttime DESC','SQL_CALC_FOUND_ROWS * ');//根据条件获取结果集
			 if(isset($_GET["data"])){
			 /*写日志*/	
				$param = array(
				'mid'=>80,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>4,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Ui/UiList'),//操作地址
				'node'=>'路演点击量-搜索',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				}
			$this->render('StoClicktj',array(
	        					'pages'      => $data['pager'],
	        					'list'       => $data['list'],
	        					'total'      => $data['total'],
	        					'currentPage'=> $page,
								'pagesize'   => $pagesize,
								'lj'		 => $lj
	        				));
		}else{
			$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : Yii::app()->params['postsPerPage'];//每页显示记录条数
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;//初始值
			$params = array('day'=>trim($_GET['data']));//搜索参数
			$data = Rs_ui::model()->getList($params,$page,$pagesize,'id desc','SQL_CALC_FOUND_ROWS * ');//根据条件获取结果集
			if(isset($_GET["data"])){
			 /*写日志*/	
				$param = array(
				'mid'=>80,//在云平台上的模块id
				'gid'=>1,//在云平台上的功能id
				'type'=>4,//操作类型
				'url'=>'http://roadshow.cloud.cnfol.com'.yii::app()->createUrl('Ui/UiList'),//操作地址
				'node'=>'路演点击量-搜索',//操作说明
				);
				$r = CloudIdentify::addLog($param);//写入日志	
				}
			$this->render('StoClick',array(
	        					'pages'      => $data['pager'],
	        					'list'       => $data['list'],
	        					'total'      => $data['total'],
	        					'currentPage'=> $page,
								'pagesize'   => $pagesize,
								'lj'		 => $lj
	        				));
		}				
        				
	}
}