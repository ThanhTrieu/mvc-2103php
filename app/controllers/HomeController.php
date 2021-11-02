<?php
    
    namespace app\controllers;
    
    use app\controllers\BaseController;
    use app\models\HomeModel;
    
    class HomeController extends BaseController
    {
        private $homeModel;
        public function __construct()
        {
            $this->homeModel = new HomeModel();
        }
        
        public function index()
        {
            // xu ly data - logic o day
 
            $students = $this->homeModel->getDataAdmins();
            echo "<pre>";
            print_r($students);
            die;
            
            $headers = [
                'title' => 'home page 123',
                'desc' => 'home'
            ];
            
            // load header view
            $this->loadHeaderView($headers);
            // load content view
            $this->loadView('home/index_view',[
                'student' => $students
            ]);
            // load footer view
            $this->loadFooterView();
        }
    }