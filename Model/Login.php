<?php
namespace Excellence\Override\Model;
class Login extends \Magento\Framework\Model\AbstractModel implements LoginInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'excellence_override_login';

    protected function _construct()
    {
        $this->_init('Excellence\Override\Model\ResourceModel\Login');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
