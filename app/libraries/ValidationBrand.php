<?php

namespace app\libraries;

class ValidationBrand
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 60;
    public static function validateCreateBrand($name, $logo)
    {
        $errors = [];
        $errors['empty_name'] = empty($name) ? 'Vui long nhap ten thuong hieu' : null;
        $errors['min_length_name'] = mb_strlen($name) < self::MIN_LENGTH ? 'Ten thuong hieu lon hon '.self::MIN_LENGTH.' ky tu' : null;
        $errors['max_length_name'] = mb_strlen($name) > self::MAX_LENGTH ? 'Ten thuong hieu nho hon '.self::MAX_LENGTH.' ky tu' : null;
        $errors['logo'] = empty($logo) ? 'vui long upload logo thuong hieu' : null;
        return $errors;
    }
}
