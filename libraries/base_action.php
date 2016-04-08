<?php

class Base_Action 
{
	static function action($e, $controller, $method, $params){

		$base_action = O('base_action');
		$point = O('base_point',['sid' => session_id()]);
		$module = MODULE_ID;
		$base_action->ctime = time();
		$base_action->base_point = $point;
		$base_action->module = $module;
		$base_action->action = $method;
		
		if (Base_Action::is_fresh()) {

			if ($base_action->id) {
				$base_action->save();
			}else{
				$base_action->save();
			}

		}
	}

	private static function is_fresh(){
		
		if ($_SERVER['PHP_SELF'] == $_SESSION['PHP_SELF']) {			
			return FALSE;   
		}else{
			return TRUE;
		}
	}
	

}