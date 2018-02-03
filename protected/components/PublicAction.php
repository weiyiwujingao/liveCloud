<?php
/*
 * PublicAction provides some component which are common and be repeatedly called.
 */
class PublicAction {

    /*
	 * this is company list.
	 * date : null
	 * return array
	 */
	public static function CorpList() {
		   $companyArray = array ();
			$criteria=new CDbCriteria(array(
//				'order'=>id ASC'
			));
	        $companyArray= Rs_corp::model()->findAll($criteria);
			return $companyArray;
	}

/**
     * 将内容加入到memcache中
     *   未指定key_prefix时，则前缀用"全局的前缀+模块名称"
     *   未指定expire时，则使用全局的expire
     *
     * @param      key
     * @param      value
     * @param      key_prefix
     * @param      cache_expire
     * @access     public
     * @return     void
    */
    function  addtocache($mod,$key, $value, $key_prefix=0, $cache_expire=0) {
        $key_prefix   = $key_prefix?$key_prefix:Yii::app()->params['memcache_prefix'].$mod;
        $cache_expire = $cache_expire?$cache_expire:Yii::app()->params['memcache_expire'];
        $cache = Cache::getInstant($key_prefix);
        return $cache->set($key, $value, $cache_expire);
    }
}
?>