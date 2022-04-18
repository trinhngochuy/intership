<?php

namespace App\Helpers\Libraries;

use phpDocumentor\Reflection\Types\Array_;
use stdClass;

class RedisQueueLib
{
    const numberQueue = 50;
    public static function push($queueName, $type, $actionType, $data, $notificationData = array())
    {
        $data = is_array($data) || is_object($data) ? json_encode($data) : $data;
        $queueData = new stdClass();
        $queueData->type = $type;
        $queueData->data = $data;
        $queueData->notificationData = json_encode($notificationData);
        $queueData->actionType = $actionType;
        $encodedData = json_encode($queueData);
        //env('REDIS_HOST'), env('REDIS_PORT'), env('REDIS_PASSWORD'), env('REDIS_DATABASE'),env('REDIS_DB')
        $redis = new RedisClient(env('REDIS_HOST'), env('REDIS_PORT'), env('REDIS_PASSWORD'), env('REDIS_DATABASE'),env('REDIS_DB'));
        $redis->Enqueue($queueName, $encodedData);
    }
    public static function getArrayQueue($queueName){
       $arrayQueue = array();
        $redis = new RedisClient(env('REDIS_HOST'), env('REDIS_PORT'), env('REDIS_PASSWORD'), env('REDIS_DATABASE'),env('REDIS_DB'));
for ($i=0;$i<self::numberQueue;$i++){
    $jsonString = $redis->Dequeue($queueName);
    if (is_null($jsonString)){
        break;
    }
    $arrayQueue[] =  json_decode($jsonString, true);
}
return $arrayQueue;
    }

}
