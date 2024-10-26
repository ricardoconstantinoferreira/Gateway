<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\Config\Source;

class Method implements \Magento\Framework\Option\ArrayInterface
{
    const POST = 'post';

    const GET = 'get';

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::POST, 'label' => __('Post')],
            ['value' => self::GET, 'label' => __('Get')]
        ];
    }
}
