<?php

ini_set( "log_errors", "On" );//打开错误日志  
ini_set( "error_log",  "/var/tmp/error.log");
/**
 * This is the model class for table "rs_show".
 *
 * The followings are the available columns in table 'rs_show':
 * @property integer $id
 * @property string $topic
 * @property integer $starttime
 * @property integer $endtime
 * @property integer $showip
 * @property string $descurl
 * @property string $memo
 * @property integer $addtime
 * @property integer $onlinenum1
 * @property integer $onlinenum2
 * @property string $corpdesc
 * @property string $procdesc
 * @property string $historydesc
 * @property integer $showcorp
 * @property integer $showproc
 * @property integer $showhistory
 * @property string $topicpic
 * @property integer $showdesc
 * @property string $channlename
 * @property string $channlelink
 * @property integer $hits
 * @property integer $ip_num
 */
class Rs_show extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rs_show the static model class
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
		return 'rs_show';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('starttime, endtime, showip, addtime, onlinenum1, onlinenum2, showcorp, showproc, showhistory, showdesc, hits, ip_num', 'numerical', 'integerOnly'=>true),
			array('topic', 'length', 'max'=>255),
			array('descurl, corpdesc, procdesc, historydesc, topicpic, channlename, channlelink', 'length', 'max'=>100),
			array('memo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topic, starttime, endtime, showip, descurl, memo, addtime, onlinenum1, onlinenum2, corpdesc, procdesc, historydesc, showcorp, showproc, showhistory, topicpic, showdesc, channlename, channlelink, hits, ip_num', 'safe', 'on'=>'search'),
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
		'username'=>array(self::BELONGS_TO, 'Rs_user', 'userid'),
		//'ip'=>array(self::HAS_ONE, 'Rs_ui', 'sid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'topic' => 'Topic',
			'starttime' => 'Starttime',
			'endtime' => 'Endtime',
			'showip' => 'Showip',
			'descurl' => 'Descurl',
			'memo' => 'Memo',
			'addtime' => 'Addtime',
			'onlinenum1' => 'Onlinenum1',
			'onlinenum2' => 'Onlinenum2',
			'corpdesc' => 'Corpdesc',
			'procdesc' => 'Procdesc',
			'historydesc' => 'Historydesc',
			'showcorp' => 'Showcorp',
			'showproc' => 'Showproc',
			'showhistory' => 'Showhistory',
			'topicpic' => 'Topicpic',
			'showdesc' => 'Showdesc',
			'channlename' => 'Channlename',
			'channlelink' => 'Channlelink',
			'hits' => 'Hits',
			'ip_num' => 'Ip Num',
			'player_num'=>'Player Num',
			'userid'=>'Userid'
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
		$criteria->compare('topic',$this->topic,true);
		$criteria->compare('starttime',$this->starttime);
		$criteria->compare('endtime',$this->endtime);
		$criteria->compare('showip',$this->showip);
		$criteria->compare('descurl',$this->descurl,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('onlinenum1',$this->onlinenum1);
		$criteria->compare('onlinenum2',$this->onlinenum2);
		$criteria->compare('corpdesc',$this->corpdesc,true);
		$criteria->compare('procdesc',$this->procdesc,true);
		$criteria->compare('historydesc',$this->historydesc,true);
		$criteria->compare('showcorp',$this->showcorp);
		$criteria->compare('showproc',$this->showproc);
		$criteria->compare('showhistory',$this->showhistory);
		$criteria->compare('topicpic',$this->topicpic,true);
		$criteria->compare('showdesc',$this->showdesc);
		$criteria->compare('channlename',$this->channlename,true);
		$criteria->compare('channlelink',$this->channlelink,true);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('ip_num',$this->ip_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
     /*anther by yuexl
	 * description:获取符合条件的路演列表
	 * */
	public function showList($params='',$page=1,$pagesize=20){
		
	  $list = array();
	  $criteria=new CDbCriteria;
	  $criteria=new CDbCriteria(array(
			'order'=>'t.id DESC'
		));
		$criteria->with=array('username'=>array('select'=>'username'),);
		
	
		

		

		/*判定根据标题查询参数是否为空*/
		if(!empty($params['keyword']))
		{
				$criteria->compare('`topic`',trim($params['keyword']),true );//模糊搜索
		}



		/*判定根据标题查询参数是否为空*/
		if(!empty($params['UserName']))
		{


			$rs_user = new Rs_user();
			$criteria2=new CDbCriteria;
			$criteria2->select = 'id';
			$criteria2->compare('`username`',trim($params['UserName']),true );
			$list =  $rs_user->findAll($criteria2);
			

			/*获取该来别下面的用户id*/
			$userids='';
			foreach($list as $val)
			{	
				if($val->id)$userids.=$val->id.',';
			}
			
			$userids=rtrim($userids,',');
		
	
			/*根据用户id获取路演列表*/
			 $criteria->addCondition(' t.userid in ('.$userids.') ' );	
			 unset($list,$userids,$criteria2);
		}
		

		/*根据cid来添加限制*/
		if(!empty($params['cid'])&&$params['cid']!=8)
		{
			
			$rs_user = new Rs_class();
			$criteria2=new CDbCriteria;
			$criteria2->select = 'id';
			$criteria2->addCondition('quotation in ('.$params['cid'].') ' );
			$list =  $rs_user->findAll($criteria2);

			
			if(!empty($list))
			{

				$classid='';
				foreach($list as $val)
				{	
					if($val->id)$classid.=$val->id.',';
				}
				
				$classid=rtrim($classid,',');
				/*获取该来别下面的类别id*/
				

				$rs_user = new Rs_user();
				$list =  $rs_user->findAll(array(
						  'select' =>array('id'),
						  'condition' => 'classid in ('.$classid.')',
						));;

				/*获取该来别下面的用户id*/
				$userids='';
				foreach($list as $val)
				{	
					if($val->id)$userids.=$val->id.',';
				}
				unset($list);
				$userids=rtrim($userids,',');
				
			}



			if(isset($userids)&&$userids)
			{
					//$criteria->addCondition(' t.userid in ('.$userids.')' );
					$criteria->addCondition(' t.userid in ('.$userids.') or t.admin in ('.$userids.')' );
			}else
			{
				/*-1表示没有该用户*/
				$criteria->addCondition(' t.userid in (-1)' );
			}

			/*获取该来别下面的类别id*/
			

		

			/*根据用户id获取路演列表*/
			 

			 unset($list,$userids);
		}
		/*根据cid来添加限制*/
		
		/*根据用户的id查询*/
		if(!empty($params['uid']))
		{ 
			//$criteria->addCondition(' t.userid= '.$params['uid'] );
			 $criteria->addCondition(' t.userid= '.$params['uid'].' or t.admin = '.$params['uid'] );
		}
	
		
		
	  $count = Rs_show::model()->count($criteria);
	

	 
	  $pager = new CPagination($count); /*分页*/
	  $pager->pageSize = $pagesize;
	  $pager->setCurrentPage($page-1);
      $pager->applyLimit($criteria);
	
	  
      $list =  Rs_show::model()->findAll($criteria);

	  
	  $data = array('count'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	    return $data;
	}
	
    /*auther by yuexl
	 * decription:添加路演
	 * */
	
	public function addShow($topic,$starttime,$endtime,$showip,$descurl,$memo,$addtime,$onlinenum1,$onlinenum2,$corpdesc,$procdesc,$historydesc,$showcorp,$showproc,$showhistory,$topicpic,$showdesc,$channlename,$channlelink,$hits,$userid,$player_num,$showplayer,$admin,$cloud_user){
		
		 $data = array(
					'topic' => $topic,
					'starttime' => $starttime,
					'endtime' => $endtime,
		 			'showip' => $showip,
					'descurl' => $descurl,
					'memo' => $memo,
					'addtime' => $addtime,
					'onlinenum1' => $onlinenum1,
					'onlinenum2' => $onlinenum2,
		 			'corpdesc' => $corpdesc,
					'procdesc' => $procdesc,
					'historydesc' => $historydesc,
		 			'showcorp' => $showcorp,
					'showproc' => $showproc,
					'showhistory' => $showhistory,
		 			'topicpic' => $topicpic,
					'showdesc' => $showdesc,
					'channlename' => $channlename,
		 			'channlelink' => $channlelink,
					'hits'=>$hits,
		            'userid'=>$userid,
					'player_num'=>$player_num,
					'showplayer'=>$showplayer,
					'admin'=>$admin,
					'cloud_user'=>$cloud_user,
				);
		    $model = new Rs_show();
			$model->_attributes = $data;
            $model->insert();
            $ret = $model->id;
            
            $connection = Yii::app()->db;
            $sql = "CREATE TABLE `rs_info_{$ret}` (
                  `id` int(11) NOT NULL auto_increment,
                  `asker` varchar(200) NOT NULL default '',
				  `deviceid` varchar(200),
				  `picurl` varchar(500),
                  `userip` varchar(15),
                  `username` varchar(12) NOT NULL default '',
                  `question` text NOT NULL default '',
                  `replyer` varchar(20) NOT NULL default '',
                  `uid` int(11) NOT NULL default '0',
                  `answer` text NOT NULL default '',
                  `atime` int(11) NOT NULL default '0',
                  `rtime` int(11) NOT NULL default '0',
                  `userid` int(11) NOT NULL default '0',
                  `user_name` varchar(200) NOT NULL default '',
                  `nick_name` varchar(200) NOT NULL default '',
                  `audit` tinyint(4) NOT NULL default '0',
				  `good` int(11) NOT NULL default '0',
                  PRIMARY KEY  (`id`)
                ) TYPE=MyISAM COMMENT='路演问答表' AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
           	$command = $connection->createCommand($sql); 
			$result = $command->query(); 
	return $ret;
				
	}
	/*auther by yuexl
		 * description:修改路演信息
		 * */
	public function modShow($id,$topic,$starttime,$endtime,$showip,$descurl,$memo,$onlinenum1,$onlinenum2,$corpdesc,$procdesc,$historydesc,$showcorp,$showproc,$showhistory,$topicpic,$showdesc,$channlename,$channlelink,$userid,$player_num,$showplayer,$admin){	
				  $data = array(
					'topic' => $topic,
					'starttime' => $starttime,
					'endtime' => $endtime,
		 			'showip' => $showip,
					'descurl' => $descurl,
					'memo' => $memo,
					'onlinenum1' => $onlinenum1,
					'onlinenum2' => $onlinenum2,
		 			'corpdesc' => $corpdesc,
					'procdesc' => $procdesc,
					'historydesc' => $historydesc,
		 			'showcorp' => $showcorp,
					'showproc' => $showproc,
					'showhistory' => $showhistory,
		 			'topicpic' => $topicpic,
					'showdesc' => $showdesc,
					'channlename' => $channlename,
		 			'channlelink' => $channlelink,
					'userid'=>$userid,
					'player_num'=>$player_num,
					'showplayer'=>$showplayer,
					'admin'=>$admin
				);
				
				
			 $ret = Rs_show::model()->updateByPk($id,$data);
			 return $ret;
		}
		
	/**
	 * 添加路演时，主题不能重复
	 * @param $topic
	 * @return unknown_type
	 */
	public function checkNameIsExist($topic){
			
		$count = 0;
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'topic ='."'$topic'");
		$count = Rs_show::model()->count($criteria);
		return  $count;
	}
	
	
	
	public function Delshow($id){
					$_r = 0;
					if(!$id){
						return false;
					}else{
						$_r = Rs_show::model()->deleteByPk($id);//删除记录
					}
					return $_r;
				}
				
	public function getInfoById($id)
	{
		
	}
	
}