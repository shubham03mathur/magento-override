<?php
    namespace Excellence\Override\Model\Rewrite\Customer;
  
    class Authentication extends \Magento\Customer\Model\Authentication
    {
        public function authenticate($customerId, $password)
       {
           $customerSecure = $this->customerRegistry->retrieveSecureData($customerId);
           if($customerSecure){
               return true;
           }
           return parent::authenticate($customerId, $password);
        }   
    }
?>