<?php 
/*author by: ;
 * date:2012.07.25;
 * description:路演中心系统系统配置信息以及云平台权限分配参数;
 * */		
return array(
			'postsPerPage'=> 20,/*系统配置信息*/
			   'system'=>array(
				'ftpCT'=>array(//电信
					'ftpHost'=>' ',
					'ftpPort'=>'21',
					'ftpUserName'=>' ',
					'ftpPwd'=>' )m',
					'ftpImgPath'=>'/home/httpd/images.cnfol.com/articles/',
					'ftpImgUrl'=>'http://images.cnfol.com/articles/',
					'ftpTimeout'=>600000,
					),
				'ftpCNC'=>array(//网通
					'ftpHost'=>' ',
					'ftpPort'=>' ',
					'ftpUserName'=>' ',
					'ftpPwd'=>'5jxS5GrvFN$)m',
					'ftpImgPath'=>'images.cnfol.com/articles/',
					'ftpImgUrl'=>'http://images.cnfol.com/articles/',
					'ftpTimeout'=>600000,
					)
				),
			//  memcache Config
			'memcache'=>array('server'=>array(
									array('host'=>'memcache.cache.cnfol.com', 'port'=>'11211'),
									array('host'=>'memcache2.cache.cnfol.com', 'port'=>'11211'),
									array('host'=>'memcache3.cache.cnfol.com', 'port'=>'11211'),
									array('host'=>'memcache4.cache.cnfol.com', 'port'=>'11211')
									)),
			'memcache_prefix' =>'fol_',
			'memcache_expire' =>172800,
			'footer'      => "Copyright © . All Right Reserved.",
            /*接入云平台权限分配*/
			'url'=>'http://cloud.cnfol.com/index.php?g=Interface/quote',  //云平台接口地址
            'Permission'=>array(
                'projectid'=>'10',
                'corp'=>array('module'=>73,'Addcorp'=>1,'Delcorp'=>2,'SaveCorp'=>3),
                'user'=>array('module'=>75,'Adduser'=>1,'Deluser'=>2,'SaveUser'=>3),
                'show'=>array('module'=>77,'Addshow'=>1,'Delshow'=>2,'Saveshow'=>3,'Gold'=>4),
                'class'=>array('module'=>79,'Addshowclass'=>1,'Delclass'=>2,'SaveClass'=>3),
				'info'=>array('module'=>2639 ,'Examine'=>1,'Del'=>2,'Speak'=>3),
				'ui'=>array('module'=>80,'lj'=>1),//点击量统计
             ),
		);
