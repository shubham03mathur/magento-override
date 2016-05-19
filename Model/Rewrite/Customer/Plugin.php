<?php

namespace Excellence\Override\Model\Rewrite\Customer\Authentication;

class Plugin
{   
	protected $messageManager;
    public function __construct(\Magento\Framework\Message\ManagerInterface $messageManager,
    	\Magento\Framework\View\Element\Template\Context $context)
    {
       $this->messageManager = $messageManager;
       parent::__construct($context);
    }
 
    public function beforeAuthenticate($subject,$customerId, $password){
    	$this->messageManager->addSuccess('Authenticating...');
        return [$customerId, $password];
    }
}
?>