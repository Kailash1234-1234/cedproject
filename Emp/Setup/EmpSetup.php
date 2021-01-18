<?php
namespace Ced\Emp\Setup;
use Magento\Eav\Setup\EavSetup;

class EmpSetup extends EavSetup {

    public function getDefaultEntities() {

        $empEntity = \Ced\Emp\Model\Emppost::ENTITY;
        $entities = [
            $empEntity => [
                'entity_model' =>'Ced\Emp\Model\ResourceModel\Emppost', //the full resource model class name 
                'table' => 'emp_entity',
                'attributes' => [
                    'emp_code' => [
                        'type' => 'static',
                    ],
                    'emp_email' => [
                        'type' => 'static',
                    ],
                    'emp_name' => [
                        'type' => 'static',
                    ],
                    'emp_mobile' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];

        return $entities;
    }
}
