<?php
namespace Excellence\Override\Model\ResourceModel\Login;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Excellence\Override\Model\Login','Excellence\Override\Model\ResourceModel\Login');
    }
}
