<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ced\APItest\Model\Api\Data;

/**
 * Brand  data model.
 */
class Brand extends \Magento\Framework\Model\AbstractExtensibleModel implements
     \Ced\APItest\Api\Data\BrandInterface
{
    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get brandname
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->getData(self::BRAND_NAME);
    }

    /**
     * Get branddesc
     *
     * @return string
     */
    public function getBrandDesc()
    {
        return $this->getData(self::BRAND_DESC);
    }

    /**
     * Get brandstatus
     *
     * @return string
     */
    public function getBrandStatus()
    {
        return $this->getData(self::BRAND_STATUS);
    }

    /**
     * Set id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set brandname
     *
     * @param string $brandname
     * @return $this
     */
    public function setBrandName($brandname)
    {
        return $this->setData(self::BRAND_NAME, $brandname);   
    }

    /**
     * Set branddesc
     *
     * @param string+ $branddesc
     * @return $this
     */
    public function setBrandDesc($branddesc)
    {
        return $this->setData(self::BRAND_DESC, $branddesc);
    }

    /**
     * Set brandstatus
     *
     * @param int $brandstatus
     * @return int|null
     */
    public function setBrandStatus($brandstatus)
    {
        return $this->setData(self::BRAND_STATUS, $brandstatus);
    }
}
