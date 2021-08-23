<?php

namespace App\Services\Bill;

use App\Exceptions\GeneralException;
use App\Models\Bill;
use App\Helper\Validation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PayBillService{

    public static function pay($body){

        $token = $body["token"];
        $buyerName = $body["buyerName"];
        $buyerDocument = $body["buyerDocument"];
        $buyerPhone = Validation::validateIsSet($body,'buyerPhone');
        $ip = $body["ip"];

        $bill = Bill::where('token',$token)->first();

        if(!isset($bill)){
            throw  new GeneralException("Factura no existe");
        }

        if($bill->status == "approved"){
            throw  new GeneralException("Factura ya ha sido pagada");
        }

        $bill->status = 'approved';
        $bill->buyer_name = $buyerName;
        $bill->buyer_phone = $buyerPhone;
        $bill->buyer_document = $buyerDocument;
        $bill->payment_ip = $ip;

        try {
            DB::beginTransaction();
            $bill->save();
            User::find($bill->user_id)->increment('balance', $bill->total_amount);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            throw new GeneralException("Ocurrio un error procesando su pago");
        }

        return $bill;
    }

}
