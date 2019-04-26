<?php

namespace modules\rest\v1\controllers;

use craft\helpers\ArrayHelper;
use flipbox\craft\restful\filters\transform\TransformFilter;
use modules\rest\v1\actions\users\Index;
use modules\rest\v1\actions\users\View;
use modules\rest\v1\transformers\UserTransformer;

class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'transform' => [
                    'class' => TransformFilter::class,
                    'transformer' => UserTransformer::class
                ]
            ]
        );
    }

    /**
     * @inheritdoc
     */
    protected function verbs(): array
    {
        return array_merge(
            parent::verbs(),
            [
                'view' => ['GET'],
                'index' => ['GET']
            ]
        );
    }

    /**
     * @return array
     */
    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
                'view' => [
                    'class' => View::class,
                ],
                'index' => [
                    'class' => Index::class
                ]
            ]
        );
    }
}
