<?php


namespace Ced\Customer\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

class UpgradeData implements UpgradeDataInterface
{

    private $customerSetupFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context){

        $setup->startSetup();
        //  die(__FILE__);
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'area_of_interest', [
                'type' => 'varchar',
                'label' => 'area_of_interest',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 333,
                'system' => false,
                'backend' => ''
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'area_of_interest')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]]);
            $attribute->save();


            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'favorite_color', [
                'type' => 'varchar',
                'label' => 'favorite_color',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 333,
                'system' => false,
                'backend' => ''
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'favorite_color')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]]);
            $attribute->save();

            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'active', [
                'type' => 'int',
                'label' => 'active',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 333,
                'system' => false,
                'backend' => ''
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'active')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]]);
            $attribute->save();
            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'year_of_creadit_card', [
                'type' => 'varchar',
                'label' => 'year_of_creadit_card',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 333,
                'system' => false,
                'backend' => ''
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'year_of_creadit_card')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]]);
            $attribute->save();


        
    }
}