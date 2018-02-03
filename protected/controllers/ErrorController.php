<?php
class ErrorController extends Controller
{
	/**
	 * This is the action to handle external exceptions.
	 */
public function actionError()
	{
//		header("Content-type:text/html; Charset=utf-8");
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
public function actionMessage()
	{
		header("Content-type:text/html; Charset=utf-8");
		$this->render('message');
	}
}
