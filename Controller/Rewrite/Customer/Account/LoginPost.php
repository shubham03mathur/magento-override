<?php
namespace Excellence\Override\Controller\Rewrite\Customer\Account;
 
 
class LoginPost extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        \Magento\Framework\App\Action\Context $context)
    {
        return parent::__construct($context);
    }
     
    public function execute()
    {
        
        if ($this->session->isLoggedIn() || !$this->formKeyValidator->validate($this->getRequest())) {
            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*/*/');
            return $resultRedirect;
        }
        if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');
            if (!empty($login['username']) && !empty($login['password'])) {
                try {
                     print_r('Its working so far!!'); die();
                    $customer = $this->customerAccountManagement->authenticate($login['username'], $login['password']);
                    $this->session->setCustomerDataAsLoggedIn($customer);
                    $this->session->regenerateId();
                    $redirectUrl = $this->accountRedirect->getRedirectCookie();
                    if (!$this->getScopeConfig()->getValue('customer/startup/redirect_dashboard') && $redirectUrl) {
                        $this->accountRedirect->clearRedirectCookie();
                        $resultRedirect = $this->resultRedirectFactory->create();
                        // URL is checked to be internal in $this->_redirect->success()
                        $resultRedirect->setUrl($this->_redirect->success($redirectUrl));
                        return $resultRedirect;
                    }
                } catch (EmailNotConfirmedException $e) {
                    $value = $this->customerUrl->getEmailConfirmationUrl($login['username']);
                    $message = __(
                        'This account is not confirmed. <a href="%1">Click here</a> to resend confirmation email.',
                        $value
                    );
                    $this->messageManager->addError($message);
                    $this->session->setUsername($login['username']);
                } catch (UserLockedException $e) {
                    $message = __(
                        'The account is locked. Please wait and try again or contact %1.',
                        $this->getScopeConfig()->getValue('contact/email/recipient_email')
                    );
                    $this->messageManager->addError($message);
                    $this->session->setUsername($login['username']);
                } catch (AuthenticationException $e) {
                    $message = __('Invalid login or password.');
                    $this->messageManager->addError($message);
                    $this->session->setUsername($login['username']);
                } catch (\Exception $e) {
                    // PA DSS violation: throwing or logging an exception here can disclose customer password
                    $this->messageManager->addError(
                        __('An unspecified error occurred. Please contact us for assistance.')
                    );
                }
            } else {
                $this->messageManager->addError(__('A login and a password are required.'));
            }
        }
        return $this->accountRedirect->getRedirect();

        return parent::execute();
    } 
}
