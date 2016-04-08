<?php
 	
$config['auth.login'][] = "Base_point::login_point";

$config['auth.logout'][] = "Base_point::logout_point";

$config['controller[*].ready'][] = "Base_Action::action";