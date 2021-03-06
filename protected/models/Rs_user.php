<?php

/**
 * This is the model class for table "rs_user".
 *
 * The followings are the available columns in table 'rs_user':
 * @property integer $id
 * @property integer $cid
 * @property integer $classid
 * @property string $username
 * @property string $password
 * @property integer $sex
 * @property string $userdesc
 * @property integer $isadmin
 * @property integer $addtime
 * @property integer $userid
 * @property string $user_name
 * @property string $nick_name
 * @property string $ischeck
 */
class Rs_user extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_user the static model class
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
		return 'rs_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userdesc', 'required'),
			array('cid, sex, isadmin, addtime, userid ,classid ', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('password', 'length', 'max'=>32),
			array('user_name, nick_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cid, username, password, sex, userdesc, isadmin, addtime, userid, user_name, nick_name', 'safe', 'on'=>'search'),
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
		'corpname'=>array(self::BELONGS_TO, 'Rs_corp', 'cid'),
		'classname'=>array(self::BELONGS_TO, 'Rs_class', 'classid'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cid' => 'Cid',
			'classid'=>'Classid',
			'username' => 'Username',
			'password' => 'Password',
			'sex' => 'Sex',
			'userdesc' => 'Userdesc',
			'isadmin' => 'Isadmin',
			'addtime' => 'Addtime',
			'userid' => 'Userid',
			'user_name' => 'User Name',
			'nick_name' => 'Nick Name',
			'ischeck'=>'Ischeck',
			'head_photo'=>'Head Photo',
			'user_column'=>'User Column',
			'user_descurl'=>'User Descurl',
			'issuperuser' => 'Issuperuser',

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
		$criteria->compare('cid',$this->cid);
		$criteria->compare('classid',$this->classid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('userdesc',$this->userdesc,true);
		$criteria->compare('isadmin',$this->isadmin);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('nick_name',$this->nick_name,true);
		$criteria->compare('check',$this->check);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   /*anther by yuexl
	 * description:获取符合条件的公司列表
	 * */
	public function userList($params='',$page=1,$pagesize=20)
	{
	  $list = array();
	 // $criteria=new CDbCriteria;
	  $criteria=new CDbCriteria(array('order'=>'t.id DESC'));
	  $criteria->with=array('corpname'=>array('select'=>'corpname'),);
	  $criteria->with=array('classname'=>array('select'=>'classname'),);
		if(!empty($params)){
			if($params['username']){
					$criteria->compare('`username`',trim($params['username']),true );//模糊搜索
				}
		}
	  $count = Rs_user::model()->count($criteria);
	  $pager = new CPagination($count); /*分页*/
	  $pager->pageSize = $pagesize;
	  $pager->setCurrentPage($page-1);
      $pager->applyLimit($criteria);
      $list =  Rs_user::model()->findAll($criteria);
	  $data = array('count'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	  return $data;
	}
	
	
	public function  getuserlist($cid=''){
				$list = array();
				  $criteria=new CDbCriteria;
				  $criteria=new CDbCriteria(array(
						'order'=>'id DESC'
					));
				if($cid&&$cid!=8)
				{
					$rs_user = new Rs_class();
					$criteria2=new CDbCriteria;
					$criteria2->select = 'id';
					$criteria2->addCondition('quotation in ('.$cid.') ' );
					$list =  $rs_user->findAll($criteria2);

					if(!empty($list))
					{
					

						/*获取该来别下面的用户id*/
						$classid='';
						foreach($list as $val)
						{	
							if($val->id)$classid.=$val->id.',';
						}
						
						$classid=rtrim($classid,',');

				
						/*根据用户id获取路演列表*/
						 $criteria->addCondition(' t.classid in ('.$classid.') ' );	
					}else
					{
						 $criteria->addCondition(' t.classid in (-1) ' );	
					}
					 unset($list,$classid,$criteria2);

				}			
				$list =  Rs_user::model()->findAll($criteria);
				return $list;
			}
   /*auther by yuexl
	 * decription:添加公司
	 * */
	
	public function addUser($username,$sex,$password,$userdesc,$isadmin,$cid,$userid,$user_name,$nick_name,$addtime,$classid,$check,$head_photo,$user_column,$user_descurl,$specialty)
	{
		 $data = array(
					'username' => $username,
		            'cid'=>$cid,
					'sex' => $sex,
					'password'=>$password,
		            'userdesc'=>$userdesc,
		            'isadmin'=>$isadmin,
		            'userid'=>$userid,
		            'user_name'=>$user_name,
		            'nick_name'=>$nick_name,
		            'addtime'=>$addtime,
		 			'classid'=>$classid,
					'ischeck'=>$check,
					 'head_photo'=>$head_photo,
					'user_column'=>$user_column,
					'user_descurl'=>$user_descurl,
					'specialty'=>$specialty
				);
		    $model = new Rs_user();
			$model->_attributes = $data;
            $ret = $model->insert();
			return $ret;
				
	}
     /**
	 * 添加用户时，同一个公司的用户名不能重复
	 * @param $corpname
	 * @return unknown_type
	 */
	public function checkNameIsExist($username,$cid){
			
		$count = 0;
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'cid ='."'$cid'");
		$criteria->addCondition ( 'username ='."'$username'");		
		$count = Rs_user::model()->count($criteria);
		return  $count;
	}
	
	
	public function  checkuserisadmin($uid){
		$criteria = new CDbCriteria ();	
		$criteria->addCondition ( 'id ='."'$uid'");
		$list = Rs_user::model()->findAll($criteria);		
		return $list;
				}
	
     /*auther by yuexl
	 * description:修改用户信息
	 * */
	public function modUser($id,$username,$sex,$password,$userdesc,$isadmin,$cid,$issuperuser,$userid,$user_name,$nick_name,$addtime,$classid,$check,$head_photo,$user_column,$user_descurl,$specialty){
			 $data = array(
			        'username' => $username,
		            'cid'=>$cid,
					'sex' => $sex,
					'password'=>$password,
		            'userdesc'=>$userdesc,
		            'isadmin'=>$isadmin,
		            'userid'=>$userid,
				    'issuperuser'=>$issuperuser,
		            'user_name'=>$user_name,
		            'nick_name'=>$nick_name,
		            'addtime'=>$addtime,
			 		'classid'=>$classid,
					'ischeck'=>$check,
				    'head_photo'=>$head_photo,
					'user_column'=>$user_column,
					'user_descurl'=>$user_descurl,
					'specialty'=>$specialty
				);
            $ret = Rs_user::model()->updateByPk($id,$data);
			return $ret;
	}
	
		public function Deluser($id){
				$_r = 0;
				if(!$id){
					return false;
				}else{
					$_r = Rs_user::model()->deleteByPk($id);//删除记录
				}
				return $_r;
			}
	
			
}