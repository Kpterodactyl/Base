<?php

class Base_Action 
{
	static function action($e, $controller, $method, $params){
        if (in_array($method, Config::get('action.shield_methods'))) {
			return;
		}
		else {
			$base_action = O('base_action');
			$point = O('base_point',['sid' => session_id()]);
			$module = MODULE_ID;
			$base_action->ctime = time();
			$base_action->base_point = $point;
			$base_action->module = $module;
			$base_action->action = $method;	
			if (Base_Action::not_fresh()) {  
			$action = Q("base_action[base_point={$point}][module={$module}][action={$method}]")->current();  	
				if($action->id){       
					if(time() - $action->ctime > 60) {
						$base_action->save();
					}
					else {
						return;
					}
				}
				else {
					$base_action->save();
				}
			}
	    }
	}
	
	private static function not_fresh() {
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'];
		if($pageWasRefreshed) {			
			return FALSE;   
		}else{
			return TRUE;
		}
	}
	

}