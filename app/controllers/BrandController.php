<?php
    
    namespace app\controllers;
    
    use app\controllers\BaseController;
    
    class BrandController extends BaseController
    {
        const PATH_LOGO_BRAND = 'public/logo/brand/';
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            // trang hien thi danh sach cac thuong hieu
            $headers = [
                'title' => 'Quan ly thuong hieu',
                'desc' => 'Thuong hieu'
            ];
            
            // load header view
            $this->loadHeaderView($headers);
            // load content view
            $this->loadView('brand/index_view');
            // load footer view
            $this->loadFooterView();
        }

        public function add()
        {
            // hien thi giao dien them moi
            $headers = [
                'title' => 'Them moi thuong hieu',
                'desc' => 'Thuong hieu'
            ];
            
            // load header view
            $this->loadHeaderView($headers);
            // load content view
            $this->loadView('brand/add_view');
            // load footer view
            $this->loadFooterView();
        }

        public function handleAdd()
        {
            if(isset($_POST['btnAddBrand'])) {
                $nameBrand = $_POST['nameBrand'] ?? '';
                $nameBrand = trim(strip_tags($nameBrand));

                $slug = slugify($nameBrand);

                $description = $_POST['descBrand'] ?? '';
                $description = trim(strip_tags($description));

                // xu ly upload anh
                $logo = uploadFileToServer($_FILES['logoBrand'], self::PATH_LOGO_BRAND, 1);
               
                // xu ly - kiem tra tinh hop le du lieu
                // du lieu hop le moi tien hanh inset vao db
                // du lieu ko hop le - thong bao loi cho nguoi dung
            }
        }
    }