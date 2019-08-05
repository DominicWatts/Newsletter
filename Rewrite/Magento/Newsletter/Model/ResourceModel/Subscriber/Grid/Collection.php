<?php

namespace Xigen\Newsletter\Rewrite\Magento\Newsletter\Model\ResourceModel\Subscriber\Grid;

/**
 * Class Collection
 * @package Xigen\Newsletter\Rewrite\Magento\Newsletter\Model\ResourceModel\Grid\Collection
 */
class Collection extends \Magento\Newsletter\Model\ResourceModel\Subscriber\Grid\Collection
{
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->showCustomerInfo(true)->addSubscriberTypeField()->showStoreInfo();
        $this->_map['fields']['name'] = 'main_table.name';
        return $this;
    }
}