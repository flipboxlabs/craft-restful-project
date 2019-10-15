<?php

namespace modules\rest\v1\controllers;

use craft\helpers\ArrayHelper;
use flipbox\craft\restful\filters\Cors;
use yii\rest\OptionsAction;

class Controller extends \flipbox\craft\restful\controllers\AbstractController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'corsFilter' => [
                    'class' => Cors::class
                ],
                'authenticator' => [
                    'except' => [
                        'options',
                        'head'
                    ]
                ]
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
                'options' => [
                    'class' => OptionsAction::class
                ]
            ]
        );
    }
}