<?php

namespace App\Http\Controllers;


use App\Exceptions\GeneralException;
use App\Helper\GeneralResponse;
use App\Services\Bill\CreateBillService;
use App\Services\Bill\ListBillService;
use App\Services\Bill\PayBillService;
use App\Services\Bill\ValidationCreateBill;
use App\Services\Bill\ValidationPayBill;
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

    public function listBill(Request $request){

        try{
            $body = $request->request->all();
            $dte = ListBillService::listBill($body);
            return GeneralResponse::buildResponse("true","Facturas listadas con éxito",[$dte]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function listBillByFrequency(Request $request,$frequency){
        try{
            $body = $request->request->all();
            $dte = ListBillService::listBillByFrequency($body["userId"],$frequency);
            return GeneralResponse::buildResponse("true","Facturas listadas con éxito",$dte);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function getBillByToken(Request $request,$token){
        try{
            $bill = ListBillService::listBillByToken($token);
            return GeneralResponse::buildResponse("true","Factura listada con éxito",[$bill]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function payBill(Request $request){

        try{
            $body = $request->request->all();
            $body["ip"] = $request->ip();
            ValidationPayBill::validate($body);
            $bill = PayBillService::pay($body);
            return GeneralResponse::buildResponse("true","Factura pagada con éxito",[$bill]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

}
