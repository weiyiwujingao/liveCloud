<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/*author by jiameng1015@126.com
	 * date:2012.07.25
	 * description:根据得到的云平台信息验证用户有无此操作权限;
	 * */
	public function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			$ControllerID = strtolower($this->id);
			$MethodID = strtolower($this->action->id);
			if( $ControllerID=="info" ) return true;
			if( $ControllerID=="error" ) return true;
			if(CloudIdentify::checkLogin()){
				$data = Yii::app()->params['Permission'][$ControllerID];
				$Mid = $data['module'];
				$return = CloudIdentify::checkModule($Mid);
				$r = explode('|',$return);
				if($r[0]!='1'){
					$this->redirect(array('error/message','message'=>$r[1]));
					exit;
				}else{
					return true;
				}
			}
			$this->redirect('http://cloud.cnfol.com/');
		}
	}
}