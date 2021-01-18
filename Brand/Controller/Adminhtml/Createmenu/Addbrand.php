<?php
namespace Ced\Brand\Controller\Adminhtml\Createmenu;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Addbrand extends Action implements HttpGetActionInterface
{
    const MENU_ID = 'Ced_Brand::addbrand';

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
        // echo "hello i am add brand";
        // die(__FILE__);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(static::MENU_ID);
       // $resultPage->getConfig()->getTitle()->prepend(__('Hello World'));
        return $resultPage;
    }
}
?>