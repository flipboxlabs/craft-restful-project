<?php

namespace modules\rest\v1\actions\users;

use craft\elements\User;
use flipbox\craft\ember\actions\elements\ElementIndex;
use flipbox\craft\ember\helpers\QueryHelper;
use modules\rest\v1\actions\DataProviderTrait;
use yii\db\QueryInterface;

class Index extends ElementIndex
{
    use DataProviderTrait;

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
