<?php
// namespace Ced\Helloworld\Controller\Adminhtml\Create;
// class Index extends \Magento\Backend\App\Action
// {
//          protected $resultPageFactory = false;      
//          public function __construct(
//                  \Magento\Backend\App\Action\Context $context,
//                  \Magento\Framework\View\Result\PageFactory $resultPageFactory
//          ) {
//                  parent::__construct($context);
//                  $this->resultPageFactory = $resultPageFactory;
//          } 
//          public function execute()
//          {
//                  $resultPage = $this->resultPageFactory->create();
//                  $resultPage->setActiveMenu('Ced_Helloworld::helloworld');
//                  $resultPage->getConfig()->getTitle()->prepend(__());
//                  return $resultPage;
//          }
//          protected function _isAllowed()
//          {
//                  return $this->_authorization->isAllowed('Ced_Helloworld::helloworld');
//          }
// }
?>
<?php
namespace Ced\Helloworld\Controller\Adminhtml\Create;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action implements HttpGetActionInterface
{
    const MENU_ID = 'Ced_Helloworld::greetings_helloworld';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return Page
     */
    public function execute()
    {  
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(static::MENU_ID);
       // $resultPage->getConfig()->getTitle()->prepend(__('Hello World'));
        return $resultPage;
    }
}
?>