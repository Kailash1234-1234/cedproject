<?php
/**
* Copyright © Magento, Inc. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Ced\Helloworld\Controller\Addproduct;

class Addproductlist extends \Magento\Framework\App\Action\Action
{
protected $_likepostFactory;


public function __construct(
\Magento\Framework\App\Action\Context $context,
\Magento\Framework\View\Result\PageFactory $pageFactory,
\Ced\Helloworld\Model\LikepostFactory $likepostFactory)
{
$this->_pageFactory = $pageFactory;
$this->_likepostFactory = $likepostFactory;
return parent::__construct($context);
}
/**
* [execute description]
* @return [type] [description]
*/
public function execute()
{

$productid=$_REQUEST['prodid'];
$ipaddress=$_SERVER['REMOTE_ADDR'];
//echo($ipaddress);



$post = $this->getRequest()->getPost();
$model = $this->_objectManager->create('Ced\Helloworld\Model\Likepost');

$likeip = $model->getCollection()
                        ->addFieldToFilter('like_message',['eq' => $ipaddress])
                        ->addFieldToFilter('like_set_id',['eq' => $productid])
                        ->count();
if($likeip>0){
    return false;
} else {
    $model->setData([
        "like_set_id" => $productid,
        "like_count"=> 1,
        "dislike_count"=>0,
        "like_message"=>$ipaddress
        ]);
        $model->save();
        if($model->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
            } else {
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
            }
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('helloworld/product/listproduct');
            return $resultRedirect;
            }
}                        


}