<?php
namespace api\versions\v1\controllers;

use Yii;
use yii\web\Response;
use yii\helpers\Json;
use yii\rest\Controller;
use common\models\LoginForm;
use modules\user\models\User;
use yii\web\HttpException;
use linslin\yii2\curl;

/**
 * Class UserController
 * @package api\versions\v1\controllers
 */
class UserController extends Controller
{
    public function actionOauthFacebook()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $request = Yii::$app->request;
        $curl = new curl\Curl();
        
        $accessTokenUrl = 'https://graph.facebook.com/v2.3/oauth/access_token';
        $graphApiUrl = 'https://graph.facebook.com/v2.3/me';
        $params = [
            'code' => $request->post('code'),
            'client_id' => $request->post('clientId'),
            'redirect_uri' => $request->post('redirectUri'),
            'client_secret' => 'fbd4f238813283c77a09cad03e93847b'
        ];
        
        $response = $curl->setOption(
        CURLOPT_POSTFIELDS, 
        http_build_query($params))
        ->post('https://graph.facebook.com/v2.3/oauth/access_token');
        $accessToken = Json::decode($curl->response);
        
        $response = $curl->reset()
        ->get($graphApiUrl . '?access_token=' . $accessToken['access_token'] );
        $profile = Json::decode($curl->response);
        
        $user = User::findOne([
            'provider' => 'facebook',
            'idProvider' => $profile['id'],
        ]);
        
        if($user){
            return ['access_token' => $user['token']];
        }
        
        $model = new User;
        $model->generateToken();
        $model->provider = 'facebook';
        $model->idProvider = $profile['id'];
        $model->name = $profile['name'];
        $model->email = $profile['email'];
        $model->token = $user->getToken();
        $model->createdAt = time();
        $model->updatedAt = time();
        $model->save();
        
        return ['access_token' => $user['token']];
//        throw new HttpException(409, 'The requested Item could not be found.');
    }
    
    /**
     * This method implemented to demonstrate the receipt of the token.
     * Do not use it on production systems.
     * @return string AuthKey or model with errors
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return \Yii::$app->user->identity->getToken();
        } else {
            return $model;
        }
    }
}
