<?php

    namespace app\models;
    
    use app\models\BaseModel;
    
    class HomeModel extends BaseModel
    {
        public function getDataStudents()
        {
            return [
                [
                    'id' => 1,
                    'name' => 'Van Teo',
                    'email' => 'vanteo@gmail.com',
                    'phone' => '03324242',
                    'address' => 'Ha Noi',
                    'gender' => 1,
                    'age' => 20,
                    'money' => 1000
                ],
                [
                    'id' => 2,
                    'name' => 'Van Ty',
                    'email' => 'vanty@gmail.com',
                    'phone' => '0332428842',
                    'address' => 'Ha Noi',
                    'gender' => 1,
                    'age' => 18,
                    'money' => 1000
                ],
                [
                    'id' => 3,
                    'name' => 'thi A',
                    'email' => 'thia@gmail.com',
                    'phone' => '033242448842',
                    'address' => 'Bac Ninh',
                    'gender' => 0,
                    'age' => 18,
                    'money' => 1000
                ]
            ];
        }
    }