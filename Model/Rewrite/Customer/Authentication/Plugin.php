<?php

namespace Excellence\Override\Model\Rewrite\Customer\Authentication;

class Plugin
{   
    public function __construct(\Magento\Framework\Message\ManagerInterface $messageManager)
    {
       $this->messageManager = $messageManager;
    }
 
    public function beforeAuthenticate($subject,$customerId, $password){
    	$this->messageManager->addSuccess('Authenticating...'); 
        return [$customerId, $password];
    }
}






?>