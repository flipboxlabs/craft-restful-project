<?php

namespace modules\rest\v1\controllers;

use Craft;
use craft\elements\User;
use craft\helpers\ArrayHelper;
use flipbox\craft\restful\filters\transform\TransformFilter;
use modules\rest\v1\actions\users\Create;
use modules\rest\v1\actions\users\Delete;
use modules\rest\v1\actions\users\Index;
use modules\rest\v1\actions\users\Update;
use modules\rest\v1\actions\users\View;
use modules\rest\v1\transformers\UserTransformer;
use yii\filters\AccessControl;

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
                ],
                'authenticator' => [
                    'optional' => ['index', 'view', 'create'] // JWT is optional for these actions
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create'],
                            'roles' => ['@', '?'] // Can be a guest or logged in
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update', 'delete'],
                            'roles' => ['@'] // Must be logged in
                        ]
                    ]
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
                'index' => ['GET'],
                'create' => ['POST'],
                'update' => ['PATCH', 'PUT'],
                'delete' => ['DELETE']
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
                ],
                'create' => [
                    'class' => Create::class
                ],
                'update' => [
                    'class' => Update::class,
                    'checkAccess' => [$this, 'checkUpdateAccess']
                ],
                'delete' => [
                    'class' => Delete::class,
                    'checkAccess' => [$this, 'checkDeleteAccess']
                ]
            ]
        );
    }

    /**
     * Check if the user can be updated
     */
    public function checkUpdateAccess(User $user): bool
    {
        if (null === ($currentUser = Craft::$app->getUser()->getIdentity())) {
            return false;
        }

        // Allow admins and the owner
        if ($this->isAdmin($currentUser) || $currentUser->getId() == $user->getId()) {
            return true;
        }

        return false;
    }

    /**
     * Check if the user can be deleted
     */
    public function checkDeleteAccess(User $user): bool
    {
        if (null === ($currentUser = Craft::$app->getUser()->getIdentity())) {
            return false;
        }

        // Prevent deletion of admins
        if ($this->isAdmin($user)) {
            return false;
        }

        // Allow admins and the owner
        if ($this->isAdmin($currentUser) || $currentUser->getId() == $user->getId()) {
            return true;
        }

        return false;
    }

    /**
     * @param User|null $user
     * @return bool
     */
    protected function isAdmin(User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        return (bool)$user->admin;
    }

}
