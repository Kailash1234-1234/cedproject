<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ced\APItest\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Brand interface.
 * @api
 * @since 100.0.2
 */
interface BrandInterface /*extends ExtensibleDataInterface*/
{
    /**#@+
     * Constants for keys of data array
     */
    const ID = 'brand_id';
    const BRAND_NAME = 'brand_name';
    const BRAND_DESC = 'brand_desc';
    const BRAND_STATUS = 'brand_status';

    /**#@-*/

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get brandname
     *
     * @return string
     */
    public function getBrandName();

    /**
     * Set brandname
     *
     * @param string $brandname
     * @return $this
     */
    public function setBrandName($brandname);

    /**
     * Get brand desc
     *
     * @return string 
     */
    public function getBrandDesc();

    /**
     * Set brand desc
     *
     * @param string $branddesc
     * @return $this
     */
    public function setBrandDesc($branddesc);

     /**
     * Get id
     *
     * @return int|null
     */
    public function getBrandStatus();

    /**
     * Set id
     *
     * @param int $brandstatus
     * @return $this
     */
    public function setBrandStatus($brandstatus);
}
