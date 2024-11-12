<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace PixieMedia\Newsletter\Observer\Frontend\Newsletter;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class SubscriberSaveBefore implements ObserverInterface
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * Subscriber constructor.
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->request = $request;
    }

    /**
     * Execute observer
     * @param Observer $observer
     */
    public function execute(Observer $observer): void
    {
        $subscriber = $observer->getEvent()->getSubscriber();

        if ($this->request->isPost() && $this->request->getPostValue('name')) {
            $name = $this->request->getPostValue('name');
            if ($name) {
                $subscriber->setName($name);
            }
        }
    }
}
