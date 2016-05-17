<?php
namespace Excellence\Override\Model\ResourceModel;
class Login extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('excellence_override_login','excellence_override_login_id');
    }
}
