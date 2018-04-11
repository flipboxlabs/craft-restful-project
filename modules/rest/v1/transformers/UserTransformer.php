<?php

namespace modules\rest\v1\transformers;

use craft\elements\User;
use Flipbox\Transform\Transformers\AbstractTransformer;
use Flipbox\Transform\Transformers\Traits\ObjectToArray;

class UserTransformer extends AbstractTransformer
{
    use ObjectToArray;

    /**
     * @param User $user
     * @return array
     */
    protected function transform(User $user): array
    {
        return [
            'id' => $user->getId(),
            'firstName' => $user->firstName,
            'lastName' => $user->lastName
        ];
    }
}
