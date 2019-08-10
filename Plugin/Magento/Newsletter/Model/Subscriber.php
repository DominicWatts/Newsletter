<?php

namespace Xigen\Newsletter\Plugin\Magento\Newsletter\Model;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Subscriber
 * @package Xigen\Newsletter\Plugin\Magento\Newsletter\Model
 */
class Subscriber
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
     * @param $subject
     * @param \Closure $proceed
     * @param $email
     * @return mixed
     * @throws \Exception
     */
    public function aroundSubscribe($subject, \Closure $proceed, $email)
    {
        if ($this->request->isPost() && $this->request->getPostValue('name')) {
            $name = $this->request->getPostValue('name');
            if ($name) {
                $subject->setName($name);
            }
            $result = $proceed($email);
            try {
                $subject->save();
            } catch (\Exception $e) {
                throw new LocalizedException($e->getMessage());
            }
        }
        return $result;
    }
}
