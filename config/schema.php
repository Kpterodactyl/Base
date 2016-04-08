<?php 
//对于一个用户来说一次登录的信息
$config['base_point'] = [
	'fields' => [
		'user' => ['type'=>'object','oname'=>'user'],
		'sid' => ['type'=>'varchar(100)','null'=>FALSE,'default'=>''],
		'address' => ['type'=>'varchar(50)','default'=>''], 
		'dtstart' => ['type'=>'int','default'=>0],
		'dtend' => ['type'=>'int','default'=>0],
		'browser' => ['type'=>'varchar(150)','default'=>''], 
		'signout_way' => ['type'=>'int','default'=>'0']

	],
	'indexes' =>[
		'user' => ['fields'=>['user']],
		'sid' => ['type'=>'unique','fields'=>['sid']],
		'address' => ['fields'=>['address']],
		'browser' => ['fields'=>['browser']],
	],
];
//每一次用户操作的信息(对哪个模块进行了那种操作) 
$config['base_action'] = [
     'fields' => [
     	'base_point' => ['type'=>'object','oname'=>'base_point'],
		'action' => ['type'=>'varchar(50)','default'=>''],
		'module' => ['type'=>'varchar(50)','null'=>FALSE,'default'=>''],
		'ctime' => ['type'=>'int','null'=>FALSE,'default'=>0],
     ],
     'indexes' =>[
		'base_point' => ['fields'=>['base_point']],
		'action' => ['fields'=>['action']],
		'module' => ['fields'=>['module']],
	],
];