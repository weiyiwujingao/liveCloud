<?php

/**
 * This is the model class for table "{{ui}}".
 *
 * The followings are the available columns in table '{{ui}}':
 * @property integer $id
 * @property string $day
 * @property integer $uv
 * @property integer $pv
 * @property integer $ip
 * @property integer $addtime
 * @property string $type
 */
class Rs_ui extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ui the static model class
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
		return 'rs_ui';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uv, pv, ip, addtime', 'numerical', 'integerOnly'=>true),
			array('day', 'length', 'max'=>20),
			array('type', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, day, uv, pv, ip, addtime, type', 'safe', 'on'=>'search'),
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
			'day' => 'Day',
			'uv' => 'Uv',
			'pv' => 'Pv',
			'ip' => 'Ip',
			'addtime' => 'Addtime',
			'type' => 'Type',
		);
	}
	/*author by jiameng1015@126.com
	 * date:2012.08.15
	 * description:根据条件获取结果集并返回
	 * @$params   查询参数  array 默认为空;
	 * @$page     当前页码  int   默认为1;
	 * @$pagesize 每页显示记录条数  int 默认为20;
	 * @$order    排序参数  字符型  默认为空;
	 * @$select   查询字段列表  字符型  默认为* 表示所有字段
	 * 返回值  数组  array(记录总数,记录结果集,分页)
	 * */
	public function getList($params='',$page=1,$pagesize=20,$order='',$select='*'){
		$list = array();
		$data = array();
		$criteria=new CDbCriteria(array('order'=>$order,'select'=>$select));
		if( !empty($params) ){/*如果设置了搜索条件，则加上搜索条件来查询列表*/
			if($params['day'] && $params['day']){
				$searchday = date('Y_m_d',strtotime($params['day']));
				$criteria->addCondition("`day`='$searchday'");
			}
		}
		$count = Rs_ui::model()->count($criteria);
        $pager = new CPagination($count);
		$pager->pageSize = $pagesize;
		$pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
		$list = Rs_ui::model()->findAll($criteria);//获取结果集
		$data = array('total'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	    return $data;
	}
	/*author by jiameng1015@126.com
	 * date:2012.08.15
	 * description:根据条件获取结果集并返回
	 * @$params   查询参数  array 默认为空;
	 * @$page     当前页码  int   默认为1;
	 * @$pagesize 每页显示记录条数  int 默认为20;
	 * @$order    排序参数  字符型  默认为空;
	 * @$select   查询字段列表  字符型  默认为* 表示所有字段
	 * 返回值  数组  array(记录总数,记录结果集,分页)
	 * */
	public function getPVlist($params='',$page=1,$pagesize=20,$order='',$select='*'){
		$conn = Yii::app()->db; //获取数据库连接对象;
		$list = array();
		$data = array();
		$criteria=new CDbCriteria(array('order'=>$order,'select'=>$select));
		if( !empty($params) ){/*如果设置了搜索条件，则加上搜索条件来查询列表*/
			if($params['topic'] && $params['topic']){
				$temparr = explode(' ', $params['topic']);
				foreach ($temparr as $v) $criteria->compare('`topic`',$v,true,'OR');
			}
		}
		$count = Rs_show::model()->count($criteria);
        $pager = new CPagination($count);
		$pager->pageSize = $pagesize;
		$pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
		$list = Rs_show::model()->findAll($criteria);//获取结果集
		$data = array('total'=>$count,
					   'list'=>$list,
					   'pager'=>$pager
					  );
	    return $data;
	}
	
}