<?php

    namespace app\controllers;
    
    class BaseController
    {
        protected $pathView = 'app/views/';

        public function __construct()
        {
            if(!$this->checkSessionLogin()){
                header('Location:index.php?c=login');
                exit();
            }
        }

        protected function checkSessionLogin()
        {
            $idUser = $this->getSessionIdUser();
            $email = $this->getSessionEmailUser();
            if($idUser !== 0 && filter_var($email, FILTER_VALIDATE_EMAIL)){
                // da login
                return true;
            }
            return false;
        }

        protected function getSessionUserName()
        {
            $user = $_SESSION['username'] ?? '';
            return $user;
        }

        protected function getSessionIdUser()
        {
            $id = $_SESSION['id'] ?? '';
            $id = is_numeric($id) ? $id : 0;
            return $id;
        }

        protected function getSessionEmailUser()
        {
            $email = $_SESSION['email'] ?? '';
            return $email;
        }
        
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
            $username = $this->getSessionUserName();
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