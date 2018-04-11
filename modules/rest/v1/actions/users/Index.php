<?php

namespace modules\rest\v1\actions\users;

use craft\elements\User;
use flipbox\ember\actions\element\ElementIndex;
use flipbox\ember\helpers\QueryHelper;
use yii\db\QueryInterface;

class Index extends ElementIndex
{
    /**
     * @inheritdoc
     */
    protected function createQuery(array $config = []): QueryInterface
    {
        $query = User::find();

        if (!empty($config)) {
            QueryHelper::configure(
                $query,
                $config
            );
        }

        return $query;
    }
}
