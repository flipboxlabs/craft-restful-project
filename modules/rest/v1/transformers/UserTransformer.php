<?php

namespace modules\rest\v1\transformers;

use craft\elements\User;
use Flipbox\Transform\Transformers\AbstractTransformer;

class UserTransformer extends AbstractTransformer
{
    /**
     * @param User $data
     * @return array
     */
    public function __invoke(User $data = null): array
    {
        if ($data === null) {
            return [];
        }

        return [
            'id' => $data->getId(),
            'firstName' => $data->firstName,
            'lastName' => $data->lastName
        ];
    }
}
