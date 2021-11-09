<?php

    namespace app\models;
    
    use app\models\BaseModel;
    use \PDO;
    
    class LoginModel extends BaseModel
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function checkLoginUser($user, $pass)
        {
            $infoUser = [];
            // :tham so truyen vao cau lenh sql - xu ly no bang PDO
            $sql = "SELECT `id`, `username`, `email`, `phone` FROM `admins` WHERE `username` = :user OR `email` = :email AND `password` = :pass AND `status` = 1";
            $stmt = $this->db->prepare($sql);
            if($stmt){
                // vi trong cau lenh sql mh co truyen tham so
                $stmt->bindParam(':user', $user, PDO::PARAM_STR);
                $stmt->bindParam(':email', $user, PDO::PARAM_STR);
                $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
                // thuc thi cau lenh
                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        // chac chan cau lenh sql chi tra ve 1 row
                        $infoUser = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                $stmt->closeCursor();
            }

            return $infoUser;
        }
    }