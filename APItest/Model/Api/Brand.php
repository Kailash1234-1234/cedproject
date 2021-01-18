<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ced\APItest\Model\Api;
use Ced\Brand\Model\ResourceModel\Brandpost;
use Ced\Brand\Model\BrandpostFactory;


/**
 * Customer Group data model.
 */
class Brand  implements \Ced\APItest\Api\BrandRepositoryInterface
{
    protected $brandpostFactory;
    protected $brandpostReasource;
    public function __construct(
        \Ced\APItest\Model\Api\Data\BrandFactory $brandFactory,
        \Ced\APItest\Model\Api\Data\BrandDataFactory $brandDataFactory,
        Brandpost $brandpostReasource,
        BrandpostFactory $brandpostFactory
    )
    {
       $this->brandFactory=$brandFactory;
       $this->brandpostFactory=$brandpostFactory;
       $this->brandpostReasource= $brandpostReasource;
       $this->brandDataFactory=$brandDataFactory;
    }
    public function save(\Ced\APItest\Api\Data\BrandInterface $brand){

        $model = $this->brandpostFactory->create();
        $model->setData([
            'brand_name' => $brand['brand_name'],
            'brand_desc' => $brand['brand_desc'],
            'brand_status' => $brand['brand_status'],
        ]);
        $this->brandpostReasource->save($model);

        $finalresult = $this->brandDataFactory->create();

        $finalresult->setData([
            'success' => true,
            'message' => "Successfully Added",
            'brand' => $model

        ]);
              return $finalresult;
    }
}