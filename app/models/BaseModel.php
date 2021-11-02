<?php

    namespace app\models;

    use app\configs\Database as Model;
    
    class BaseModel extends Model
    {
        // tien ich dung cho cac models
        public function __construct()
        {
            parent::__construct(); // chay construct cua class Database
            // xu ly ben duoi
        }
        
    }