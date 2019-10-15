<?php

namespace modules\rest\v1\actions\users;

use flipbox\craft\ember\actions\elements\UpdateElement;

class Update extends UpdateElement
{
    /**
     * @var array
     */
    public $validBodyParams = [
        'firstName',
        'lastName'
    ];

    /**
     * @inheritdoc
     */
    public function run($id)
    {
        return parent::run($id);
    }

    /**
     * @inheritdoc
     */
    protected function find($identifier)
    {
        return $this->findById($identifier);
    }
}
