<?php

namespace App\Listeners;

use App\Helper\Validation;
use App\Services\User\CreateUserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CreateUserListener implements ShouldQueue
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        $eventPayload = Validation::validateQueueHandleData($event);
        if(!is_null($eventPayload)){
            switch($eventPayload->eventName){
                case  "create_user":
                    CreateUserService::createUser($eventPayload->data);
                    break;
                default:
                    Log::info("Invalid eventName");
            }
        }else{
            Log::info("Invalid $eventPayload");
        }
    }
}
