<?php
namespace Excellence\Override\Model\Rewrite\Customer;
use Magento\Customer\Model\Data\CustomerSecure;
use Magento\Customer\Model\Data\CustomerSecureFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class CustomerRegistry extends Magento\Customer\Model
{

   private $customerFactory;
   private $customerSecureFactory;

   public function __construct(
        CustomerFactory $customerFactory,
        CustomerSecureFactory $customerSecureFactory
        
    ) {
        $this->customerFactory = $customerFactory;
        $this->customerSecureFactory = $customerSecureFactory;
        
    }

    public function retrieveSecureData($customerId)
    {
    	print_r('This Method is working not core one');
        if (isset($this->customerSecureRegistryById[$customerId])) {
            return $this->customerSecureRegistryById[$customerId];
        }
        /** @var Customer $customer */
        $customer = $this->retrieve($customerId);
        /** @var $customerSecure CustomerSecure*/
        $customerSecure = $this->customerSecureFactory->create();
        $customerSecure->setPasswordHash($customer->getPasswordHash());
        $customerSecure->setEmail($customer->getEmail());
        $customerSecure->setRpToken($customer->getRpToken());
        $customerSecure->setRpTokenCreatedAt($customer->getRpTokenCreatedAt());
        $customerSecure->setDeleteable($customer->isDeleteable());
        $customerSecure->setFailuresNum($customer->getFailuresNum());
        $customerSecure->setFirstFailure($customer->getFirstFailure());
        $customerSecure->setLockExpires($customer->getLockExpires());
        $this->customerSecureRegistryById[$customer->getId()] = $customerSecure;
        
        return $customerSecure;
    }


}


?>