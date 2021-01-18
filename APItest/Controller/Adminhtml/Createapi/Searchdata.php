<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\APItest\Controller\Adminhtml\Createapi;
/**
 * Save CMS block action.
 */
class Searchdata extends \Magento\Framework\App\Action\Action
{
    protected $indexFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Ced\Slider\Model\ResourceModel\Sliderpost\CollectionFactory $sliderpostFactory
        )
    {
        $this->_pageFactory = $pageFactory;
        $this->sliderpostFactory = $sliderpostFactory;
        return parent::__construct($context);
       
        
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        print_r($data);
        $catIdhere = $data['admin_category_form_field'][0]."<br>";
        // $catId = $data['admin_category_form_field'];
        // $params =['category_id'=> $catId];
        //  echo $catId."<br>";
        // $defaults = array(
        // CURLOPT_URL => 'http://192.168.2.95/magento/rest/V1/integration/admin/token',
        // CURLOPT_POST => true,
        // CURLOPT_POSTFIELDS => $params,
        // );
        // $ch = curl_init();
        // curl_setopt_array($ch, ($defaults));
        // print_r( curl_setopt_array($ch, ($defaults)));
        // die(__FILE__);



        $adminUrl='http://192.168.2.95/magento/rest/V1/integration/admin/token';
        $ch = curl_init();
        $data = array("username" => "Admin", "password" => "Admin@123");
        $dataString = json_encode($data);
        $ch = curl_init($adminUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString))
        );
        $token = curl_exec($ch);
        $token = json_decode($token);
        print_r($token);
        curl_close($ch);

        
        $productUrl='http://192.168.2.95/magento/rest/all/V1/products?searchCriteria%5BfilterGroups%5D%5B0%5D%5Bfilters%5D%5B0%5D%5Bfield%5D=category_id&searchCriteria%5BfilterGroups%5D%5B0%5D%5Bfilters%5D%5B0%5D%5Bvalue%5D='.$catIdhere;

        $ch = curl_init($productUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
            )
        );
        $productList = curl_exec($ch);
        $err      = curl_error($ch);
        $products = json_decode($productList);
        echo '<pre>';print_r($products );
        curl_close($ch);

        die;
       

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('slider/createmenu/addslider');
        return $resultRedirect;

    }
}
?>