<?php
namespace Ced\Brand\Controller\Adminhtml\Createmenu;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Showbrand extends Action implements HttpGetActionInterface
{
    const MENU_ID = 'Ced_Brand::showbrand';

    /**
     * @var PageFactory
     */
    protected $helperData;
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Ced\Brand\Helper\Data $helperData
    ) {
        $this->helperData = $helperData;
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
        $resultRedirect = $this->resultRedirectFactory->create();
        $configstatus = $this->helperData->getGeneralConfig('enable');
        // echo "hello i am show brand list";
        //  die($configstatus."kjdgfl");
        if($configstatus!=0){
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu(static::MENU_ID);
            return $resultPage;
        } else {
              $this->messageManager->addErrorMessage(__('Some thing went wrong !!, page not found.'));
                // go to grid
            return $resultRedirect->setPath('');
        }
       
        
    }
}
?>