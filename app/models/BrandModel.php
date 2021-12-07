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

    public function deleteBrandById($id)
    {
        $flagDel = false;
        $sql = "DELETE FROM `brands` WHERE `id` = :idBrand";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':idBrand', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                $flagDel = true;
            }
            $stmt->closeCursor();
        }
        return $flagDel;
    }

    public function updateBrandById($id, $nameBrand, $slug, $description, $status, $logo)
    {
        $flag = false;
        $ut = date("Y-m-d H:i:s");
        $sql = "UPDATE `brands` SET `name`=:nameBrand, `slug`=:slug, `logo`=:logo, `status`=:statusBrand, `description`=:descriptionBrand, `updated_at`=:updated_at WHERE `id`=:idBrand";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':nameBrand', $nameBrand, PDO::PARAM_STR);
            $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
            $stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
            $stmt->bindParam(':statusBrand', $status, PDO::PARAM_INT);
            $stmt->bindParam(':descriptionBrand', $description, PDO::PARAM_STR);
            $stmt->bindParam(':updated_at', $ut, PDO::PARAM_STR);
            $stmt->bindParam(':idBrand', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                $flag = true;
            }
            $stmt->closeCursor();
        }
        return $flag;
    }

    public function checkExistsNameBrandById($brand, $id)
    {
        $flag = false;
        // loai tru chinh ten thuong hieu dang sua ma kiem tra voi ten thuong hieu khac
        $sql = "SELECT `name` FROM `brands` WHERE `name` = :nameBrand AND `id` <> :idBrand";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':nameBrand', $brand, PDO::PARAM_STR);
            $stmt->bindParam(':idBrand', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() > 0) {
                    $flag = true;
                }
            }
            $stmt->closeCursor();
        }
        return $flag;
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

    public function getListBrands($keyword = '')
    {
        $data = array();
        if(empty($keyword)){
            $sql = "SELECT * FROM  `brands`";
        } else {
            $key = "%{$keyword}%";
            $sql = "SELECT * FROM  `brands` WHERE `name` LIKE :nameBrand";
        }
        $stmt = $this->db->prepare($sql);
        if($stmt){
            if(!empty($keyword)){
                $stmt->bindParam(':nameBrand', $key, PDO::PARAM_STR);
            }
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