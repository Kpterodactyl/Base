<?php

$config['habit_transfer'] = [
	'title' => '用户行为数据获取',
	//'cron' => '30 * * * *',
	'cron' =>'*/1 * * * *',
	'job' => ROOT_PATH . 'cli/cli.php habit_transfer transfer'
];
