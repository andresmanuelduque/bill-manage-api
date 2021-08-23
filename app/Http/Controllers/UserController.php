<?php


namespace App\Http\Controllers;


use App\Exceptions\GeneralException;
use App\Helper\GeneralResponse;
use App\Services\User\BalanceService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function getBalance(Request $request){
        try{
            $body = $request->request->all();
            $balance = BalanceService::getBalance($body);
            return GeneralResponse::buildResponse("true","Datos consultados con éxito",[$balance]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

}
