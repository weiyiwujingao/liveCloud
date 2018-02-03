<?php

/**
 * This is the model class for table "rs_corp".
 *
 * The followings are the available columns in table 'rs_corp':
 * @property integer $id
 * @property string $corpname
 * @property string $corpdesc
 * @property integer $addtime
 */
class Rs_corp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_corp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rs_corp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('corpdesc', 'required'),
			array('addtime', 'numerical', 'integerOnly'=>true),
			array('corpname', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, corpname, corpdesc, addtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'corpname' => 'Corpname',
			'corpdesc' => 'Corpdesc',
			'addtime' => 'Addtime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('corpname',$this->corpname,true);
		$criteria->compare('corpdesc',$this->corpdesc,true);
		$criteria->compare('addtime',$this->addtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   /*anther by yuexl
	 * description:获取符合条件的公司列表
	 * */
	public function corpList($params='',$page=1,$pagesize=20){
	  $list = array();
	  $criteria=new CDbCriteria;
	  $criteria=new CDbCriteria(array(
			'order'=>'id DESC'
		));
		if(!empty($params)){
			if($params['corpname']){
					$criteria->compare('`corpname`',trim($params['corpname']),true );//模糊搜索
				}
		}
	  $count = Rs_corp::model()->count($criteria);
	  $pager = new CPagination($count); /*分页*/
	  $pager->pageSize = $pagesize;
	  $pager->setCurrentPage($page-1);
      $pager->applyLimit($criteria);
      $list =  Rs_corp::model()->findAll($criteria);
	  $data = array('count'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	    return $data;
	}
	
	public function  getcorplist(){
		$list = array();
		  $criteria=new CDbCriteria;
		  $criteria=new CDbCriteria(array(
				'order'=>'id DESC'
			));
		$list =  Rs_corp::model()->findAll($criteria);
		return $list;
	}
	/*auther by yuexl
	 * decription:添加公司
	 * */
	
	public function addCorp($corpname,$corpdesc,$addtime){
		 $data = array(
					'corpname' => $corpname,
					'corpdesc' => $corpdesc,
					'addtime' => $addtime
				);
			$model = new Rs_corp();
			$model->_attributes = $data;
			$ret = $model->insert();
				return $ret;
				}
				
	/**
	 * 添加公司时，检查公司名称是否存在
	 * @param $corpname
	 * @return unknown_type
	 */
	public function checkCorpNameIsExist($corpname){
			
		$count = 0;
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'corpname ='."'$corpname'");	
		$count = Rs_corp::model()->count ( $criteria );
		return  $count;
	}
	
	/*auther by yuexl
	 * description:修改公司信息
	 * */
	public function modCorp($id,$corpname,$corpdesc,$addtime){
		     $model=Rs_corp::model()->findByPk($id);	
			 $data = array(
						'corpname' => $corpname,
						'corpdesc' => $corpdesc,
						'addtime' => $addtime,
					);
			 $model->_attributes = $data;
			 $ret = $model->save();
				return $ret;
	}
	/*
	 * anther by yuexl
	 * description:删除公司
	 * */
	public function Delcorp($id){
		$_r = 0;
		if(!$id){
			return false;
	    }else{
	    	$_r = Rs_corp::model()->deleteByPk($id);//删除记录
	    }
	    return $_r;
	}
								
	public function getIdByName($id){		
		$r = Rs_corp::model()->findByPk($id);
			if($r){
				return $r->corpname;
			}else{
				return '';
			}	
		}				
}