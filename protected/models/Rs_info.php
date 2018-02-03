<?php

/**
 * This is the model class for table "rs_info_1847".
 *
 * The followings are the available columns in table 'rs_info_1847':
 * @property integer $id
 * @property string $asker
 * @property string $userip
 * @property string $username
 * @property string $question
 * @property string $replyer
 * @property integer $uid
 * @property string $answer
 * @property integer $atime
 * @property integer $rtime
 * @property integer $audit
 */
class Rs_info extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_info the static model class
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
		return 'rs_info_8887';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, answer', 'required'),
			array('uid, atime, rtime, audit', 'numerical', 'integerOnly'=>true),
			array('asker, replyer', 'length', 'max'=>20),
			array('userip', 'length', 'max'=>15),
			array('username', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, asker, userip, username, question, replyer, uid, answer, atime, rtime, audit', 'safe', 'on'=>'search'),
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
			'asker' => 'Asker',
			'userip' => 'Userip',
			'username' => 'Username',
			'question' => 'Question',
			'replyer' => 'Replyer',
			'uid' => 'Uid',
			'answer' => 'Answer',
			'atime' => 'Atime',
			'rtime' => 'Rtime',
			'audit' => 'Audit',
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
		$criteria->compare('asker',$this->asker,true);
		$criteria->compare('userip',$this->userip,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('replyer',$this->replyer,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('atime',$this->atime);
		$criteria->compare('rtime',$this->rtime);
		$criteria->compare('audit',$this->audit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*查询列表*/
	public function showinfoList($params='',$page=1,$pagesize=20)
	{
		/*问题管理*/
		if($params['style']==1)
		{
			$where = ' where (audit =1 or audit =3 or audit=0)';
		}
		/*发布管理*/
		if($params['style']==2)
		{
			$where = ' where (audit =1 or audit =2)';
		}
		/*垃圾仙*/
		if($params['style']==3)
		{
			$where = ' where (audit < 0)';
		}
		/*提问对象*/
		if(!empty($params['replyer']))
		{
			$where .= ' and replyer like "%'.$params['replyer'].'%"';
		}

		if(!empty($params['asker']))
		{
			$where .= ' and asker like "%'.$params['asker'].'%"';
		}
		
		
		/*提问时间*/
		if(!empty($params['begintime']))
		{
			$where .= ' and atime >= '.strtotime($params['begintime']);
		}

		/*提问时间*/
		if(!empty($params['endtime']))
		{
			$endtimes=strtotime($params['endtime'])+24*3600;
			$where .= ' and atime <= '.$endtimes;

		}

		/*提问时间*/
		if(!empty($params['rbegintime']))
		{
			$where .= ' and rtime >= '.strtotime($params['rbegintime']);
		}

		/*提问时间*/
		if(!empty($params['rendtime']))
		{
			$rendtimes=strtotime($params['rendtime'])+24*3600;
			$where .= ' and rtime <= '.$rendtimes;
		}

			/*状态*/
		if(isset($params['audit'])&&($params['audit']!=-4))
		{
			$where .= ' and audit = '.$params['audit'];
		}


		$connection = Yii::app()->db;  
		$sql = "SELECT count(*) as total FROM `rs_info_".$params['sid']."`" .$where;  
		
		$command = $connection->createCommand($sql);  
		$count = $command->queryAll();  
		$count=$count[0]['total'];//总条数

		$list=array();
		if($count>0)
		{
			$start= ($page-1)*$pagesize;
			$sql = "SELECT *  FROM `rs_info_".$params['sid']."`" .$where .' order by id desc limit '.$start.','. $pagesize;  
			$command = $connection->createCommand($sql);  
			$list = $command->queryAll();  
		}
		
	
		
	 
	  
	  $pager = new CPagination($count); /*分页*/
	  $pager->pageSize = $pagesize;
	  $pager->setCurrentPage($page-1);
      
       
		$data = array('total'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	    return $data;
	}

	/*删除 审核 发布 记录*/
	public function modordel($id,$type,$sid,$pasrdo=1)
	{
		
		
		/**/

		$connection = Yii::app()->db;  
		/*审核 发布*/
		if($type==1)
		{
			$sql='update rs_info_'.$sid.' set audit='.$pasrdo.',rtime ='.time().' where id in ('.$id.')' ;
		}
		/*删除 发布管理 ，问题管理记录*/
		if($type==2)
		{
			
			$sql='update rs_info_'.$sid.' set audit=-(audit+1) ,rtime = '.time().'  where id in ('.$id.')' ;
		}
		/*删除垃圾箱里面记录记录*/
		if($type==3)
		{
			$sql='update rs_info_'.$sid.' set audit=-(audit+1) ,rtime = '.time().'  where id in ('.$id.')' ;
		}
		
		$command = $connection->createCommand($sql);  
		$rs = $command->execute();  
	}

	/*发布管理 发言 回复 修改 */
	public function question($sid,$type,$imageurl,$asker,$content,$id='',$status=2)
	{

		$connection = Yii::app()->db;
		/*过来不需要的标签*/
		$find=array("'");
		$replace=array('"');
		$content=str_replace($find,$replace,$content);

		

		
		

		if($type==1)
		{
			$audit = 2;//直接发布出去
			$uid = -1;//表示主持人
			$time = time();//添加时间
			$sql="insert into  rs_info_{$sid} (asker,question,uid,atime,rtime,picurl,audit) 
			values('$asker','".$content."','$uid','$time','$time','$imageurl',".$status.")";
		}

		/*获取用户的信息*/

		if($type==2)
		{	
			$sql_user="select * from rs_info_{$sid} where id = $id";
			$command_user = $connection->createCommand($sql_user);  
			$rs = $command_user->queryAll();


			/*查看用户是否需要通过审核*/
			if(!empty($rs[0]['replyer']))
			{
				$rs_user = new Rs_user();
				$list =  $rs_user->findAll(array(
						  'select' =>array('ischeck'),
						  'condition' => 'username="'.$rs[0]['replyer'].'"',
						));;
				if(!empty($list))
				{
					$ischeck=$list[0]->ischeck;
				}
			}

			
			

			$sql ="update rs_info_".$sid." set answer='".$content."', rtime = ".time() ;
			if($imageurl)
			{
				$sql.=',  picurl="'.$imageurl.'"';
			}
			
			/*修改转态*/
			if($ischeck!=1)
			{
				$sql.=',  audit=2';
			}
			$sql.=' where id = '.$id;
		}

		
		if($type==3)
		{	
			$sql ="update rs_info_".$sid." set question='".$content."' ,rtime = ".time().',atime = '.time();
			if($imageurl)
			{
				$sql.=',  picurl="'.$imageurl.'"';
			}
			$sql.=' where id = '.$id;
		}



		
		
		$command = $connection->createCommand($sql);  
		$rs = $command->execute();  
	}

}