<?php

namespace modules\rest\v1\actions\users;

use craft\base\ElementInterface;
use craft\elements\User;
use flipbox\craft\ember\actions\elements\CreateElement;

class Create extends CreateElement
{
    /**
     * @var array
     */
    public $validBodyParams = [
        'firstName',
        'lastName',
        'email',
        'username'
    ];

    /**
     * @inheritdoc
     * @return ElementInterface
     */
    protected function newElement(array $config = []): ElementInterface
    {
        return new User();
    }
}