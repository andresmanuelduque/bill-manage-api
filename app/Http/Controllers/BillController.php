<?php

namespace App\Http\Controllers;


use App\Exceptions\GeneralException;
use App\Helper\GeneralResponse;
use App\Services\Bill\CreateBillService;
use App\Services\Bill\ValidationCreateBill;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class BillController extends BaseController
{
    public function createBill(Request $request){

        try{
            $body = $request->request->all();
            $body["ip"] = $request->ip();
            ValidationCreateBill::validate($body);
            $dte = CreateBillService::create($body);
            return GeneralResponse::buildResponse("true","Factura creada con éxito",[$dte]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

}
