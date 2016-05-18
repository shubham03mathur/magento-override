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
           else
           {
           	 echo __('Please Enter Valid Email Address');
           }
           return parent::authenticate($customerId, $password);
        }   
    }
?>