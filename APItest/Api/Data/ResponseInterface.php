<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ced\APItest\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Response interface.
 * @api
 * @since 100.0.2
 */
interface ResponseInterface /*extends ExtensibleDataInterface*/
{
    /**#@+
     * Constants for keys of data array
     */
    const SUCCESS = 'success';
    const MESSAGE = 'message';
    const BRAND = 'brand';

    /**#@-*/

   /**
     * Get success
     *
     * @return bool|null
     */
    public function getSuccess();

    /**
     * Set success
     *
     * @param bool $success
     * @return $this
     */
    public function setSuccess($success);

    
    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage();

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * Get \Ced\APItest\Api\Data\BrandInterface
     *
     * @return \Ced\APItest\Api\Data\BrandInterface
     */
    public function getBrand();

    /**
     * Set \Ced\APItest\Api\Data\BrandInterface
     *
     * @param \Ced\APItest\Api\Data\BrandInterface $brand
     * @return $this
     */
    public function setBrand($brand);

}
