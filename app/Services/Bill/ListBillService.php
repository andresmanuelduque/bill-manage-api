<?php

namespace App\Services\Bill;

use App\Exceptions\GeneralException;
use App\Models\Bill;


class ListBillService{

    public static function listBill($body){

        $userId = $body["userId"];
        return Bill::where('user_id',$userId)->paginate(5);

    }

    public static function listBillByToken($token){

        $dte = Bill::where('token',$token)->first();

        if(!isset($dte)){
            throw  new GeneralException("Token no existe");
        }

        return $dte;

    }

    public static function listBillByFrequency($userId,$frequency){
        $dteQuery = Bill::where('user_id',$userId);

        if($frequency=="daily"){
            $dteQuery->whereRaw('DATE(created_at) =  DATE(NOW())');
        }

        return $dteQuery->orderBy('created_at', 'ASC')->get();
    }
}
