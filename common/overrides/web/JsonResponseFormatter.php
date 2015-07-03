<?php

namespace common\overrides\web;

class JsonResponseFormatter extends \yii\web\JsonResponseFormatter
{
    public function format($response)
    {
        //Resulting data
        $resultData = [];
        
        if (is_string($response->data)) {
            //For string result we send it like result['message']
            $resultData['result'] = ['message' => $response->data];
        } elseif ($response->getIsClientError() && isset($response->data['message'])) {
            //For HttpExceptions we save message field only to result['message']
            $resultData['result'] = ['message' => $response->data['message']];
        } else {
            //Otherwise send all as result
            $resultData['result'] = $response->data;
        }
        $resultData['code'] = $response->getStatusCode();
        $resultData['status'] = $response->statusText;
        
        //Set resulting data to response->data and run parent format function
        $response->data = $resultData;
        parent::format($response);
    }
}
