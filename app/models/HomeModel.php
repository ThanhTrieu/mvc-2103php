<?php

    namespace app\models;
    
    use app\models\BaseModel;
    use \PDO;
    
    class HomeModel extends BaseModel
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getDataAdmins()
        {
            $data = [];
            $sql = "SELECT * FROM `admins`";
            $stmt = $this->db->prepare($sql);
            // kiem tra tinh hop le cau lenh sql
            if($stmt){
                // vi cau lenh sql khong co tham so truyen vao, nen ko can kiem tra
                // thuc thi cau lenh sql 
                if($stmt->execute()){
                    // da thuc thi xong cau lenh
                    // lay du lieu
                    // kiem tra xem co data tra ve ko?
                    if($stmt->rowCount() > 0){
                        // trong bang du lieu co data
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // fetchAll: lay nhieu dong du lieu
                        //PDO::FETCH_ASSOC: Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
                    }
                }
                $stmt->closeCursor();
                // ngat thuc thi execute ben tren de thuc thi lenh moi neu co 
                // xu ly cac lenh truy van sql o day tiep theo
            }
            return $data;
        }
    }