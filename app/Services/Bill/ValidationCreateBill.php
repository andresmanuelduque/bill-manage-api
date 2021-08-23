<?php

namespace App\Services\Bill;

use App\Exceptions\GeneralException;
use App\Helper\Validation;

class ValidationCreateBill{

    public static function validate($body){

        $errors = [];

        Validation::validateEmail($errors, $body, 'email', true);
        Validation::validateStringLength($errors,$body,'buyerPhone',["gte"=>8,"lte"=>10],false);
        Validation::validateStringLength($errors,$body,'itemType',["gte"=>1,"lte"=>10],true);
        Validation::validateStringLength($errors,$body,'buyerName',["gte"=>3,"lte"=>50],false);
        Validation::validateNumberRange($errors,$body,'discountRate',["gte"=>0,"lte"=>99],false);
        Validation::validateStringLength($errors,$body,'itemName',["gte"=>3,"lte"=>100],true);
        Validation::validateStringLength($errors,$body,'itemDescription',["gte"=>0,"lte"=>500],false);
        Validation::validateIsNumeric($errors,$body,'itemQuantity',true);
        Validation::validateIsNumeric($errors,$body,'itemAmount',true);
        Validation::validateIsBoolean($errors,$body,'iva',false);
        Validation::validateIsNumeric($errors,$body,'userId',true);


        if(!empty($errors)){
            throw new GeneralException("Datos inválidos",$errors);
        }
    }

}
