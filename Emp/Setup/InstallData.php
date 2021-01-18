<?php

namespace Ced\Emp\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Brand setup factory
     *
     * @var empSetupFactory
     */
    private $empSetupFactory;

    /**
     * Init
     *
     * @param empSetupFactory $brandSetupFactory
     */
    public function __construct(EmpSetupFactory $empSetupFactory)
    {
        $this->empSetupFactory = $empSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var \Magento\Catalog\Setup\BrandSetup $brandSetup */
        $empSetup = $this->empSetupFactory->create(['setup' => $setup]);

        $empSetup->installEntities();
    }
}