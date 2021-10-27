<?php

    namespace app\controllers;
    
    class BaseController
    {
        protected $pathView = 'app/views/';
        
        protected function loadHeaderView($header = [])
        {
            extract($header);
            // truyen du lieu ra view
            /*
             $header = [
                'id' => 10,
                'name' => 'Teo'
            ]
            $id , $name : key cua mang truyen ra ngoai view lam bien hien thi du lieu
             */
            require $this->pathView."partials/header_view.php";
        }
        
        protected function loadFooterView()
        {
            require $this->pathView . "partials/footer_view.php";
        }
        
        protected function loadView($path, $data = [])
        {
            extract($data);
            require $this->pathView . $path . '.php';
        }
        
        public function __call($method, $params = [])
        {
            echo "method {$method} not found";
        }
    
        public static function __callStatic($method, $params = [])
        {
            echo "method static {$method} not found";
        }
    }