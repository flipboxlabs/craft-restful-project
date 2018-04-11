<?php

namespace modules\rest\v1;

use ArrayIterator;
use Craft;
use craft\events\RegisterUrlRulesEvent;
use craft\helpers\ArrayHelper;
use flipbox\craft\rest\UrlManager;
use flipbox\craft\restful\modules\ApiModule;
use yii\base\Event;

class V1 extends ApiModule
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_REST_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules = ArrayHelper::merge(
                    $event->rules,
                    $this->urlRules(
                        new ArrayIterator(Craft::$app->getRequest()->getSegments())
                    )
                );
            }
        );

    }

    /**
     * @return array
     */
    public function moduleUrlRules(): array
    {
        return [
            [
                'prepend' => $this->getUniqueId(),
                'prefix' => $this->getUniqueId(),
                'controller' => ['users']
            ]
        ];
    }
}
