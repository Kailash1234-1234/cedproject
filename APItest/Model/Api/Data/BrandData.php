<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ced\APItest\Model\Api\Data;

/**
 * Customer Group data model.
 */
class BrandData extends \Magento\Framework\Model\AbstractExtensibleModel implements
     \Ced\APItest\Api\Data\ResponseInterface
{
    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE); 
    }
    

    /**
     * Get \Ced\APItest\Api\Data\BrandInterface
     *
     * @return \Ced\APItest\Api\Data\BrandInterface $brand
     */
    public function getBrand()
    {
        return $this->getData(self::BRAND);
    }

    /**
     * Get success
     *
     * @return bool|null
     */
    public function getSuccess()
    {
        return $this->getData(self::SUCCESS); 
    }

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Set success
     *
     * @param bool|null $success
     * @return $this
     */
    public function setSuccess($success)
    {
        return $this->setData(self::SUCCESS, $success);
    }

     /**
     * Set \Ced\APItest\Api\Data\BrandInterface
     *
     * @param \Ced\APItest\Api\Data\BrandInterface $brand
     * @return $this
     */
    public function setBrand($brand)
    {
        return $this->setData(self::BRAND, $brand);   
    }

}
