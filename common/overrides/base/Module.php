<?php

namespace common\overrides\base;

use Yii;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
    public function init()
    {
        if ($this->controllerNamespace === null) {
            $class = get_class($this);
            if (($pos = strrpos($class, '\\')) !== false) {
                $this->controllerNamespace = substr($class, 0, $pos) . '\\controllers\\' . Yii::$app->id;
            }
        }
        //Set path to views for module application
        $this->setViewPath($this->getBasePath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . Yii::$app->id);
        
        //Add translations folder
        Yii::$app->get('i18n')->translations[$this->id . '*'] = [
            'class'    => PhpMessageSource::className(),
            'basePath' => $this->basePath . '/messages',
        ];
        
        parent::init();
    }
}
