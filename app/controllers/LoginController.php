<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\models\LoginModel;

class LoginController extends BaseController
{
    private $loginModel;
    public function __construct()
    {
        // neu da login roi - thi mac dinh vao trang home
        $method = $_GET['m'] ?? '';
        if($this->checkSessionLogin() && $method !== 'logout'){
            header('Location:?c=home');
            exit();
        }
        $this->loginModel = new LoginModel();
    }

    public function index()
    {
        // hien thi giao dien login
        $state = $_GET['state'] ?? '';
        $this->loadView('login/index_view',[
            'message' => $state
        ]);
    }

    public function handleLogin()
    {
        if(isset($_POST['btnLogin'])) {
            $username = $_POST['username'] ?? '';
            $username = trim(strip_tags($username));

            $password = $_POST['password'] ?? '';
            $password = trim(strip_tags($password));

            if(empty($username) || empty($password)) {
                // chua nhap du lieu
                // quay lai form login - thong bao loi
                header('Location:index.php?c=login&m=index&state=error');
            } else {
                // da nhap du lieu
                // kiem tra xem du lieu gui len co ton tai trong database ko?
                $dataUser = $this->loginModel->checkLoginUser($username, $password);
                if(empty($dataUser)){
                    // tai khoan ko ton tai
                    header('Location:index.php?c=login&m=index&state=fail');
                } else {
                    // tai khoan co ton tai
                    // luu thong tin user vao session de tien cho cac viec sau nay
                    $_SESSION['id'] = $dataUser['id'];
                    $_SESSION['username'] = $dataUser['username'];
                    $_SESSION['email'] = $dataUser['email'];
                    $_SESSION['phone'] = $dataUser['phone'];
                    // cho vao trang home
                    header('Location:index.php?c=home');
                }
            }
        }
    }

    public function logout()
    {
        if(isset($_POST['btnLogout'])) {
            // huy cac session va quay ve trang login
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['phone']);
            // session_destroy(); huy tat
            header('Location:?c=login');
        }
    }
}
// index.php?c=login