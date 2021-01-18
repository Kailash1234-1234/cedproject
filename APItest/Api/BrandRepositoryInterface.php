<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ced\APItest\Api;

/**
 * Brand  CRUD interface
 * @api
 * @since 100.0.2
 */
interface BrandRepositoryInterface
{
    /**
     * Save brand
     *
     * @param  \Ced\APItest\Api\Data\ResponseInterface $brand
     * @return \Ced\APItest\Api\Data\ResponseInterface
     */
    public function save(\Ced\APItest\Api\Data\BrandInterface $brand);
}
