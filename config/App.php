<?php
     class App {
        private $controller = 'landing', //?untuk nama file dan class controller
                $method = 'index', //?untuk nama methode view nya
                $param = [];

         public function __construct() {
             $url = $this->ParseUrl();

            //  !memanggil file dan class controllernya
             if (file_exists('routes/'.$url[0].'.php')) {
                 $this->controller = $url[0];
                 unset($url[0]);
             }
             require_once('routes/'.$this->controller.'.php');
             $this->controller = new $this->controller;

            //  !memanggil method view nya
            if (isset($url[1])) {
                if (method_exists($this->controller,$url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
            if (!empty($url)) {
                $this->param = array_values($url);
            }

            call_user_func_array([$this->controller,$this->method],$this->param);
         }

         protected function ParseUrl()
         {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
         }
     }