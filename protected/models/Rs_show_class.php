<?php

/**
 * This is the model class for table "rs_show_class".
 *
 * The followings are the available columns in table 'rs_show_class':
 * @property integer $id
 * @property integer $sid
 * @property integer $cid
 * @property integer $addtime
 */
class Rs_show_class extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_show_class the static model class
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
		return 'rs_show_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, cid, addtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, cid, addtime', 'safe', 'on'=>'search'),
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
		'Cname'=>array(self::BELONGS_TO, 'Rs_class', 'cid'),
		'Showmsg'=>array(self::BELONGS_TO, 'Rs_show', 'sid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sid' => 'Sid',
			'cid' => 'Cid',
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
		$criteria->compare('sid',$this->sid);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('addtime',$this->addtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function addShowclass($sid,$cid,$addtime){
			 $data = array(
						'sid' => $sid,
						'cid' => $cid,
						'addtime' => $addtime
					);
				$model = new Rs_show_class();
				$model->_attributes = $data;
				$ret = $model->insert();
					return $ret;
					}
					
					
	public function Delshowclass($sid){
			$_r = 0;
			if(!$sid){
				return false;
		    }else{
	
		    	$_r = Rs_show_class::model()->deleteAll('sid=:sid',array(':sid'=>$sid) ); //删除记录
		    }
		    return $_r;
		}
//					
	public function showclasslist($sid){
		  $list = array();
		  $data = array();
		  $criteria=new CDbCriteria;
		  $criteria=new CDbCriteria(array(
//			'order'=>'t.id DESC'
			));
		  $criteria->with=array(
		    	'Cname'=>array('select'=>'classname,id'),
			);
		  $criteria->addCondition ( 'sid ='."'$sid'");	
	      $list =  Rs_show_class::model()->findAll($criteria);
	      $count = count($list);
	      if(!empty($list)){
		      foreach($list as $item ){
		      	$data[]= array(	'classname'=>$item->Cname->classname,
		      					'id'=>$item->cid,
		      					);
		      }
	      }
	      $data['count'] = $count;
	         return $data;
						}
		public function showList($params='',$page=1,$pagesize=20){
			  $list = array();
			  $criteria=new CDbCriteria;
			  $criteria=new CDbCriteria(array(
					'order'=>'t.id DESC'
				));
				$criteria->with=array(
		    	'Showmsg'=>array('select'=>'topic,starttime,endtime,descurl,addtime'),
			    );
				if(!empty($params)){
					if($params['cid']){
							 $criteria->addCondition ( 'cid ='.$_GET['cid']);	
						}
					if($params['keyword']){
						$criteria->compare('`Showmsg`.`topic`',trim($params['keyword']),true );//模糊搜索
					}
				}
              $list =  Rs_show_class::model()->findAll($criteria);
              $count = count($list);
			  $pager = new CPagination($count); /*分页*/
			  $pager->pageSize = $pagesize;
			  $pager->setCurrentPage($page-1);
		      $pager->applyLimit($criteria);
               $data['list'] = $list;
	           $data['count'] = $count;
	           $data['pager']= $pager;
	            return $data;
			}
}