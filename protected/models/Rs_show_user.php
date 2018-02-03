<?php

/**
 * This is the model class for table "rs_show_user".
 *
 * The followings are the available columns in table 'rs_show_user':
 * @property integer $id
 * @property integer $sid
 * @property integer $cid
 * @property integer $uid
 */
class Rs_show_user extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_show_user the static model class
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
		return 'rs_show_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, cid, uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, cid, uid', 'safe', 'on'=>'search'),
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
		'username'=>array(self::BELONGS_TO, 'Rs_user', 'uid'),
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
			'uid' => 'Uid',
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
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function addShowuser($sid,$cid,$uid){
				 $data = array(
							'sid' => $sid,
							'cid' => $cid,
							'uid' => $uid
						);
					$model = new Rs_show_user();
					$model->_attributes = $data;
					$ret = $model->insert();
						return $ret;
						}
						
						
	public function Delshowuser($sid){
				$_r = 0;
				if(!$sid){
					return false;
			    }else{
		
			    	$_r = Rs_show_user::model()->deleteAll('sid=:sid',array(':sid'=>$sid) ); //删除记录
			    }
			    return $_r;
			}

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
						
	public function showuserlist($sid){
			  $list = array();
			  $data = array();
			  $criteria=new CDbCriteria;
			  $criteria=new CDbCriteria(array(
	//			'order'=>'t.id DESC'
				));
			  $criteria->with=array(
			    	'username'=>array('select'=>'username,id'),
				);
			  $criteria->distinct = FALSE;
			  $criteria->addCondition ( 'sid ='."'$sid'");	
		      $list =  Rs_show_user::model()->findAll($criteria);
			  error_log(PHP_EOL.print_r($list,true),'3','/tmp/userlist.log');
		      $count = count($list);
		      if(!empty($list)){
			      foreach($list as $item ){
					
			      	$data[]= array(	'username'=>$item->username->username,
			      					'id'=>$item->uid,
			      					);
			      }
		      }
		      $data['count'] = $count;
		         return $data;
							}
							
/*根据条件查询ID ,返回ID号数组
	 * 
	 * */
	public function getSidArr($uid){
		$criteria = new CDbCriteria(array('select'=>'sid'));
		$criteria->addCondition("uid='$uid'");
		$data = Rs_show_user::model()->findAll($criteria);
		if(!empty($data)){
			foreach($data as $key){
				$ID[] = $key->sid;
			}
		}
		return $ID;
	}
}