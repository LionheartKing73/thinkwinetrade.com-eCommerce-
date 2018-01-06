<?php
final class Loader {
	private $registry;

    protected $load;
            

	public function __construct($registry) {

    //d_event_manager.xml loader
    $this->load = new d_event_manager\Loader($this, $registry);
            
		$this->registry = $registry;
	}

	
    //d_event_manager.xml controller
    public function controller($route, $args = array()) {
        return $this->load->controller($route, $args);
    }
    
    //this is the original controller method which is called by the d_event_menager\Loader -> contorller method
    public function _controller($route, $args = array()) {
            
		$action = new Action($route, $args);

		return $action->execute($this->registry);
	}

	
    //d_event_manager.xml model
    public function model($model) {
        return $this->load->model($model);
    }
    
    //this is the original controller method which is called by the d_event_menager\Loader -> contorller method
    public function _model($model) {
            
		$file = DIR_APPLICATION . 'model/' . $model . '.php';
		$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $model);

		if (file_exists($file)) {
			include_once(VQMod::modCheck(modification($file), $file));

			
        //d_event_manager.xml proxy
        if(strpos($class, 'total') === false){
            $proxy = new d_event_manager\Proxy();
            foreach (get_class_methods($class) as $method) {
                $proxy->{$method} = $this->load->callback($this->registry, $model . '/' . $method);
            }

            $this->registry->set('model_' . str_replace(array('/', '-', '.'), array('_', '', ''), (string)$model), $proxy);
        }else{
            $this->registry->set('model_' . str_replace('/', '_', $model), new $class($this->registry));
        }
            
		} else {
			trigger_error('Error: Could not load model ' . $file . '!');
			exit();
		}
	}

	
    //d_event_manager.xml view
    public function view($route, $args = array()) {
        return $this->load->view($route, $args);
    }
    
    //this is the original controller method which is called by the d_event_menager\Loader -> contorller method
    public function _view($template, $data = array()) {
            
		$file = DIR_TEMPLATE . $template;

		if (file_exists($file)) {
			extract($data);

			ob_start();

			require(VQMod::modCheck(modification($file), $file));

			$output = ob_get_contents();

			ob_end_clean();

			return $output;
		} else {
			trigger_error('Error: Could not load template ' . $file . '!');
			exit();
		}
	}

	public function library($library) {
		$file = DIR_SYSTEM . 'library/' . $library . '.php';

		if (file_exists($file)) {
			include_once(VQMod::modCheck(modification($file), $file));
		} else {
			trigger_error('Error: Could not load library ' . $file . '!');
			exit();
		}
	}

	public function helper($helper) {
		$file = DIR_SYSTEM . 'helper/' . $helper . '.php';

		if (file_exists($file)) {
			include_once(VQMod::modCheck(modification($file), $file));
		} else {
			trigger_error('Error: Could not load helper ' . $file . '!');
			exit();
		}
	}

	
    //d_event_manager.xml controller
    public function config($route) {
        return $this->load->config($route);
    }
    
    //this is the original controller method which is called by the d_event_menager\Loader -> contorller method
    public function _config($config) {
            
		$this->registry->get('config')->load($config);
	}

	
    //d_event_manager.xml controller
    public function language($route, $args = array()) {
        return $this->load->language($route, $args);
    }
    
    //this is the original language method which is called by the d_event_menager\Loader -> language method
    public function _language($language) {
            
		return $this->registry->get('language')->load($language);
	}
}