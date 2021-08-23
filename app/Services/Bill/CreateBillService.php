<?php

namespace App\Services\Bill;

use App\Models\Bill;
use App\Helper\Validation;


class CreateBillService{

    public static function create($body){

        $email = $body["email"];
        $itemName = $body["itemName"];
        $itemQuantity = $body["itemQuantity"];
        $itemAmount = $body["itemAmount"];
        $itemType = $body["itemType"];
        $ip = $body["ip"];
        $userId = $body["userId"];

        // fill optionals params
        $buyerPhone = Validation::validateIsSet($body,'buyerPhone');
        $buyerDocument = Validation::validateIsSet($body,'buyerDocument');
        $buyerName = Validation::validateIsSet($body,'buyerName',0);
        $itemDescription = Validation::validateIsSet($body,'itemDescription');
        $discountRate = Validation::validateIsSet($body,'discountRate',0);
        $iva = Validation::validateIsSet($body,'iva',false);
        $totalAmount = ($itemAmount * $itemQuantity);

        if($discountRate>0){
            $totalAmount = $totalAmount - ($totalAmount * ($discountRate*0.01));
        }

        if($iva){
            $totalAmount = $totalAmount * (1+( env("IVA_PERCENT")*0.01));
        }

        $bill = new Bill();
        $bill->status = 'pending';
        $bill->email =  $email;
        $bill->buyer_name = $buyerName;
        $bill->buyer_phone = $buyerPhone;
        $bill->buyer_document = $buyerDocument;
        $bill->discount_rate = $discountRate;
        $bill->item_name = $itemName;
        $bill->item_description = $itemDescription;
        $bill->item_type = $itemType;
        $bill->item_qty = $itemQuantity;
        $bill->item_amount = $itemAmount;
        $bill->iva = $iva;
        $bill->payment_ip = $ip;
        $bill->token = \Illuminate\Support\Str::random(32);
        $bill->total_amount = $totalAmount;
        $bill->user_id = $userId;
        $bill->save();

//        $user = User::find($userId);

//        $emailRequest = new \stdClass();
//        $emailRequest->name = $user->firstName." ".$user->lastName;
//        $emailRequest->type = $dte->item_type;
//        $emailRequest->itemName = $dte->item_name;
//        $emailRequest->amount = $dte->total_amount;
//        $emailRequest->link = env("PAY_PAGE_URL").$dte->token;
//        Mail::to($dte->email)->send(new DteRequestMail($emailRequest));

        return $bill;
    }

}
