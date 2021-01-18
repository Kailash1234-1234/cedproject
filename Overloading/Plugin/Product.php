<?php
 
namespace Ced\Overloading\Plugin;
 
class Product
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + ($result*10)/100;
    }
}