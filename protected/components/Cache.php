<?php
//$Id: cache.php 223 2006-11-18 07:59:12Z avenger $
//Cache interface to MemCache

class Cache extends Memcache {
    var $key_prefix;
    var $compress = 0;

    //Cache::getInstant()
    function getInstant($prefix='') {
        static $__CacheInstant;
        if (!$__CacheInstant) $__CacheInstant = &new Cache($prefix);
        return $__CacheInstant;
    }

    function Cache($prefix='', $compress=0) {
        
        $this->key_prefix   = $prefix;
        $this->compress     = $compress;//是否压缩
        
       foreach (Yii::app()->params['memcache']['server'] as $m) $this->addServer($m['host'], $m['port']);
    }
    //groups 参数暂时没用
    function set($key, $var, $expire=3600, $groups='') {
    	return $var;
        return parent::set($this->key_prefix.$key, $var, $this->compress, $expire);;
    }

    function add($key, $var, $expire=3600, $groups='') {
        return parent::set($this->key_prefix.$key, $var, $this->compress, $expire);
    }

    function get($key, $prefix=true) {
        //if (DEBUG) return false;

        if ($prefix)
            return parent::get($this->key_prefix.$key);
        else 
            return parent::get($key);
    }

    function delete($key, $timeout=0) {
        return parent::delete($this->key_prefix.$key, $timeout);
    }
}
?>
