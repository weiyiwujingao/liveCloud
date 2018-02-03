<?php

/**
 * This is the model class for table "rs_class".
 *
 * The followings are the available columns in table 'rs_class':
 * @property integer $id
 * @property string $classname
 * @property string $memo
 * @property integer $addtime
 */
class Rs_class extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_class the static model class
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
		return 'rs_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('addtime', 'numerical', 'integerOnly'=>true),
			array('classname', 'length', 'max'=>255),
			array('memo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, classname, memo, addtime', 'safe', 'on'=>'search'),
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
			'classname' => 'Classname',
			'memo' => 'Memo',
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
		$criteria->compare('classname',$this->classname,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('addtime',$this->addtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
/*anther by yuexl
	 * description:获取符合条件的公司列表
	 * */
	public function showclassList($params='',$page=1,$pagesize=20){
	  $list = array();
	  $criteria=new CDbCriteria;
	  $criteria=new CDbCriteria(array(
			'order'=>'id DESC'
		));
		if(!empty($params)){
			if($params['keyword']){
				$criteria->compare('`classname`',trim($params['keyword']),true );//模糊搜索
			}
		}
	  $count = Rs_class::model()->count($criteria);
	  $pager = new CPagination($count); /*分页*/
	  $pager->pageSize = $pagesize;
	  $pager->setCurrentPage($page-1);
      $pager->applyLimit($criteria);
      $list =  Rs_class::model()->findAll($criteria);	  
		$data = array('total'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	    return $data;
	}
	
	public function  getclasslist(){
			$list = array();
			  $criteria=new CDbCriteria;
			  $criteria=new CDbCriteria(array(
					'order'=>'id DESC'
				));
			$list =  Rs_class::model()->findAll($criteria);
			return $list;
		}
	
	
   /*auther by yuexl
	 * decription:添加路演分类
	 * */
	
	public function addClass($classname,$memo,$addtime,$column_id,$channel_id,$class_logo,$navigation,$advertising,$quotation,$isshow,$column_id_1,$channel_id_1,$column_id_2,$channel_id_2){
		
		 $data = array(
					'classname' => $classname,
					'memo' => $memo,
				    'column_id' => $column_id,
				    'channel_id' => $channel_id,
				    'class_logo' => $class_logo,
				    'navigation' => $navigation,
				    'advertising' => $advertising,
				    'quotation' => $quotation,
				    'isshow' => $isshow,
					'addtime' => $addtime,
					'column_id_1' => $column_id_1,
				    'channel_id_1' => $channel_id_1,
					'column_id_2' => $column_id_2,
				    'channel_id_2' => $channel_id_2,
				);
		
			$model = new Rs_class();
			$model->_attributes = $data;
            $ret = $model->insert();
				return $ret;
						
	}
				
	/**
	 * 添加公司时，检查分类名称是否存在
	 * @param $corpname
	 * @return unknown_type
	 */
	public function checkClassNameIsExist($classname,$id=''){
			
		$count = 0;
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'classname ='."'$classname'");
		if($id)
		{
			$criteria->addCondition ( 'id ='.$id);
		}
		$count = Rs_class::model()->count($criteria);
		return  $count;
	}
	
	public function Delclass($id){
		$_r = 0;
		if(!$id){
			return false;
		}else{
			$_r = Rs_class::model()->deleteByPk($id);//删除记录
		}
		return $_r;
	}
	
    /*auther by yuexl
	 * description:修改分类信息
	 * */
	public function modClass($id,$classname,$memo,$column_id,$channel_id,$class_logo,$navigation,$advertising,$quotation,$isshow,$column_id_1,$channel_id_1,$column_id_2,$channel_id_2){
		     $model=Rs_class::model()->findByPk($id);	
			 $data = array(
						'classname' => $classname,
						'memo' => $memo,
						'column_id' => $column_id,
						'channel_id' => $channel_id,
						'column_id_1' => $column_id_1,
						'channel_id_1' => $channel_id_1,
						'column_id_2' => $column_id_2,
						'channel_id_2' => $channel_id_2,
						'class_logo' => $class_logo,
						'navigation' => $navigation,
						'advertising' => $advertising,
					    'quotation' => $quotation,
						'isshow' => $isshow
					);
			 $model->_attributes = $data;
			 $ret = $model->save();
			return $ret;
	}
}