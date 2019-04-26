<?php

namespace modules\rest\v1\actions;

use flipbox\craft\restful\data\PaginationTrait;
use yii\data\ActiveDataProvider;

trait DataProviderTrait
{
    use PaginationTrait;

    /**
     * @var array
     */
    public $dataProvider = [];

    /**
     * @param array $config
     * @return array
     */
    protected function dataProviderConfig(array $config = []): array
    {
        return array_merge(
            [
                'class' => ActiveDataProvider::class,
                'pagination' => $this->paginationConfig()
            ],
            $config,
            $this->dataProvider
        );
    }
}
