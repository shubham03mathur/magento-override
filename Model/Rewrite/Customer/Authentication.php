<?php
    namespace Excellence\Override\Model\Rewrite\Customer;
  
    class Authentication extends \Magento\Customer\Model\Customer
    {
        public function authenticate($customerId, $password)
       {
        
           $customerSecure = $this->customerRegistry->retrieveSecureData($customerId);
           $email = $customerSecure->getEmail();
           print_r($email); die();
            if (!$email) {
            $this->processAuthenticationFailure($customerId);
            if ($this->isLocked($customerId)) {
                throw new UserLockedException(__('The account is locked.'));
            }
            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
            }
           return true;
           return parent::authenticate($customerId, $password);
        }
    }
?>