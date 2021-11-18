<?php
    
namespace app\controllers;

use app\controllers\BaseController;
use app\libraries\ValidationBrand;
use app\models\BrandModel;

class BrandController extends BaseController
{
    const PATH_LOGO_BRAND = 'public/logo/brand/';
    private $brandModel;

    public function __construct()
    {
        parent::__construct();
        $this->brandModel = new BrandModel();
    }

    public function index()
    {
        $listBrands = $this->brandModel->getListBrands();
        // trang hien thi danh sach cac thuong hieu
        $headers = [
            'title' => 'Quan ly thuong hieu',
            'desc' => 'Thuong hieu'
        ];
        
        // load header view
        $this->loadHeaderView($headers);
        // load content view
        $this->loadView('brand/index_view',[
            'listBrands' => $listBrands,
            'pathLogo' => self::PATH_LOGO_BRAND
        ]);
        // load footer view
        $this->loadFooterView();
    }

    public function add()
    {
        $state = $_GET['state'] ?? null;

        $messErrors = [];
        if($state === 'error' && !empty($_SESSION['errorsCreateBrand'])){
            $messErrors = $_SESSION['errorsCreateBrand'];
        }

        $existName = null;
        if($state === 'exists' && !empty($_SESSION['existNameBrand'])){
            $existName = $_SESSION['existNameBrand'];
        }

        // hien thi giao dien them moi
        $headers = [
            'title' => 'Them moi thuong hieu',
            'desc' => 'Thuong hieu'
        ];
        
        // load header view
        $this->loadHeaderView($headers);
        // load content view
        $this->loadView('brand/add_view',[
            'messErrors' => $messErrors,
            'existName' => $existName,
            'state' => $state
        ]);
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
            $arrErrors = ValidationBrand::validateCreateBrand($nameBrand, $logo);
            $flagCheckErrors = false;
            foreach($arrErrors as $error){
                if(!empty($error)){
                    $flagCheckErrors = true;
                    break;
                }
            }

            if($flagCheckErrors){
                // co loi - thong bao loi ra ngoai view
                // quay lai dung form inset data
                deleteFileFromServer(self::PATH_LOGO_BRAND, $logo);
                $_SESSION['errorsCreateBrand'] = $arrErrors;
                header('Location:index.php?c=brand&m=add&state=error');
            } else {
                // khong co loi
                // xoa het cac loi da ton tai trong session neu co
                if(!empty($_SESSION['errorsCreateBrand'])){
                    unset($_SESSION['errorsCreateBrand']);
                }
                // kiem tra xem ten thuong hieu da ton tai trong database chua ?
                // neu chua co - tien hanh insert data
                // neu da co - thong bao loi va quay lai form insert
                $checkExists = $this->brandModel->checkExistsNameBrand($nameBrand);
                if($checkExists){
                    deleteFileFromServer(self::PATH_LOGO_BRAND, $logo);
                    // ten thuong hieu da ton tai trong database
                    $_SESSION['existNameBrand'] = $nameBrand;
                    header('Location:index.php?c=brand&m=add&state=exists');
                } else {
                    // xoa loi
                    if(!empty($_SESSION['existNameBrand'])){
                        unset($_SESSION['existNameBrand']);
                    }
                    // chua ton tai
                    // tien hanh insert data
                    $insert = $this->brandModel->insertDataBrand($nameBrand, $slug, $description, $logo);
                    if($insert){
                        // thanh cong
                        header('Location:index.php?c=brand');
                    } else {
                        // loi ko insert data
                        deleteFileFromServer(self::PATH_LOGO_BRAND, $logo);
                        header('Location:index.php?c=brand&m=add&state=fail');
                    }
                }
            }
        }
    }

    public function edit()
    {
        $idBrand = $_GET['id'] ?? null;
        $idBrand = is_numeric($idBrand) ? $idBrand : 0;

        // lay du lieu tu database thong id
        $infoBrand = $this->brandModel->getInfoBrandById($idBrand);
        if(empty($infoBrand)){
            $this->notFoundData();
        } else {

            $this->loadHeaderView();
            $this->loadView('brand/edit_view',[
                'infoBrand' => $infoBrand,
                'pathLogo' => self::PATH_LOGO_BRAND
            ]);
            $this->loadFooterView();
        }
    }

    public function handleEdit()
    {
        if(isset($_POST['btnEditBrand'])){
            $id = $_GET['id'] ?? null;
            $id = is_numeric($id) ? $id : 0;
            $infoBrand = $this->brandModel->getInfoBrandById($id);
            if(empty($infoBrand)){
                header('Location:index.php?c=brand&m=edit&id='.$id.'&state=error');
            } else {
                $nameBrand = $_POST['nameBrand'] ?? null;
                $nameBrand = strip_tags($nameBrand);
                $slug = slugify($nameBrand);

                $description = $_POST['descBrand'] ?? '';
                $description = trim(strip_tags($description));

                $status = $_POST['statusBrand'] ?? null;
                $status = ($status === '1' || $status === '0') ? $status : 0;

                $logo = $infoBrand['logo'];

                // khong bat buoc phai upload file logo
                if(!empty($_FILES['logoBrand']['tmp_name'])){
                    // nguoi dung co muon thay doi anh logo
                    // tien hanh upload anh logo
                    $logo = uploadFileToServer($_FILES['logoBrand'], self::PATH_LOGO_BRAND, 1);
                }

                // validate data
                // kiem tra rang buoc du lieu: check ten thuong hieu voi nhung thang khac, tru chinh no
                // insert data

            }
        }
    }
}