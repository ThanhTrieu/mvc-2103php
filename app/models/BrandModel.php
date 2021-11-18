<?php

namespace app\models;

use app\models\BaseModel;
use \PDO;

class BrandModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getInfoBrandById($id)
    {
        $data = [];
        $sql = "SELECT * FROM `brands` WHERE `id` = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch(PDO::FETCH_ASSOC); // one row
                }
            }
            $stmt->closeCursor();
        }
        return $data;
    }

    public function getListBrands()
    {
        $data = array();
        $sql = "SELECT * FROM  `brands`";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        return $data;
    }

    public function checkExistsNameBrand($name)
    {
        $flag = false;
        $sql = "SELECT `id`, `name` FROM `brands` WHERE `name` = :nameBrand LIMIT 1";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':nameBrand', $name, PDO::PARAM_STR);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $flag = true;
                }
            }
            $stmt->closeCursor();
        }
        return $flag;
    }

    public function insertDataBrand($name, $slug, $description, $logo)
    {
        $flag = false;
        $status = 1;
        $ct = date("Y-m-d H:i:s");
        $ut = null;
        $sql = "INSERT INTO `brands`(`name`, `slug`, `logo`, `status`, `description`, `created_at`, `updated_at`) VALUES (:nameBrand, :slugBrand, :logo, :statusBrand, :descriptionBrand, :ct, :ut)";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':nameBrand', $name, PDO::PARAM_STR);
            $stmt->bindParam(':slugBrand', $slug, PDO::PARAM_STR);
            $stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
            $stmt->bindParam(':statusBrand', $status, PDO::PARAM_INT);
            $stmt->bindParam(':descriptionBrand', $description, PDO::PARAM_STR);
            $stmt->bindParam(':ct', $ct, PDO::PARAM_STR);
            $stmt->bindParam(':ut', $ut, PDO::PARAM_STR);
            if($stmt->execute()) {
                $flag = true;
            }
            $stmt->closeCursor();
        }
        return $flag;
    }
}