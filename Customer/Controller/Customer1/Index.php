<?php 
namespace Ced\Customer\Controller\Customer1;  

class Index extends \Magento\Framework\App\Action\Action { 
public function execute() { 
   // echo "heloo i am ";
   // die;
$this->_view->loadLayout(); 
$this->_view->renderLayout(); 
} 
} 
?>
