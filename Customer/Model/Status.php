<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Customer\Model;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
   

    public function toOptionArray()
    {
        return [
            [
                self::STATUS_ENABLED => __('Yes'),
                self::STATUS_DISABLED => __('No'),
               
            ],
        ];
    }


    public static function getOptionArray()
    {
        return [
            self::STATUS_ENABLED => __('Yes'),
            self::STATUS_DISABLED => __('No'),
        ];
    }

    public function toColorArray()
    {
        return [
            [
                ['value'=>'RED', 'label'=>'RED'],
                ['value'=>'BLUE', 'label'=>'BLUE'],
                ['value'=>'GREEN', 'label'=>'GREEN'],
                ['value'=>'YELLOW', 'label'=>'YELLOW'],
                ['value'=>'PINK', 'label'=>'PINK'],
                ['value'=>'BLACK', 'label'=>'BLACK'],
                ['value'=>'DEEPPINK', 'label'=>'DEEPPINK'],
                ['value'=>'WHITE', 'label'=>'WHITE'],
                ['value'=>'ORANGE', 'label'=>'ORANGE'],
                ['value'=>'GRAY', 'label'=>'GRAY'],
                ['value'=>'LIGHTBLUE', 'label'=>'LIGHTBLUE'],
                ['value'=>'LIGHTRED', 'label'=>'LIGHTRED']
            ],
        ];
    }

    public static function getColorArray()
    {
        return [
            ['value'=>'RED', 'label'=>'RED'],
            ['value'=>'BLUE', 'label'=>'BLUE'],
            ['value'=>'GREEN', 'label'=>'GREEN'],
            ['value'=>'YELLOW', 'label'=>'YELLOW'],
            ['value'=>'PINK', 'label'=>'PINK'],
            ['value'=>'BLACK', 'label'=>'BLACK'],
            ['value'=>'DEEPPINK', 'label'=>'DEEPPINK'],
            ['value'=>'WHITE', 'label'=>'WHITE'],
            ['value'=>'ORANGE', 'label'=>'ORANGE'],
            ['value'=>'GRAY', 'label'=>'GRAY'],
            ['value'=>'LIGHTYELLO', 'label'=>'LIGHTYELLO'],
            ['value'=>'LIGHTRED', 'label'=>'LIGHTRED']
        ];
    }

    public static function toInterestAreaArray()
    {
        return [
            ['value'=>'CODING', 'label'=>'COADING'],
            ['value'=>'PLAYING', 'label'=>'PLAYING'],
            ['value'=>'GAMING', 'label'=>'GAMING'],
            ['value'=>'SINGING', 'label'=>'SINGING'],
            ['value'=>'SWIMING', 'label'=>'SWIMING'],
            ['value'=>'RIDING', 'label'=>'RIDING'],
            ['value'=>'TRAVELLING', 'label'=>'TRAVELLING'],
            ['value'=>'SLEEPING', 'label'=>'SLEEPING'],
            ['value'=>'FIGHTING', 'label'=>'FIGHTING'],
            ['value'=>'MARKITING', 'label'=>'MARKITING'],
            ['value'=>'BUSINESS', 'label'=>'BUSINESS'],
            ['value'=>'SHOPPING', 'label'=>'SHOPPING']
        ];
    }
    public static function getInterestAreaArray()
    {
        return [
            ['value'=>'CODING', 'label'=>'COADING'],
            ['value'=>'PLAYING', 'label'=>'PLAYING'],
            ['value'=>'GAMING', 'label'=>'GAMING'],
            ['value'=>'SINGING', 'label'=>'SINGING'],
            ['value'=>'SWIMING', 'label'=>'SWIMING'],
            ['value'=>'RIDING', 'label'=>'RIDING'],
            ['value'=>'TRAVELLING', 'label'=>'TRAVELLING'],
            ['value'=>'SLEEPING', 'label'=>'SLEEPING'],
            ['value'=>'FIGHTING', 'label'=>'FIGHTING'],
            ['value'=>'MARKITING', 'label'=>'MARKITING'],
            ['value'=>'BUSINESS', 'label'=>'BUSINESS'],
            ['value'=>'SHOPPING', 'label'=>'SHOPPING']
        ];
    }

    public static function toBackendTypeArray(){
        
        return [
                ['value'=>'2022', 'label'=>'2022'],
                ['value'=>'2023', 'label'=>'2023'],
                ['value'=>'2024', 'label'=>'2024'],
                ['value'=>'2025', 'label'=>'2025'],
                ['value'=>'2026', 'label'=>'2026'],
                ['value'=>'2027', 'label'=>'2027'],
                ['value'=>'2028', 'label'=>'2028'],
                ['value'=>'2029', 'label'=>'2029']
        ];
    }
    public static function getBackendTypeArray(){
        
        return [
            ['value'=>'2022', 'label'=>'2022'],
            ['value'=>'2023', 'label'=>'2023'],
            ['value'=>'2024', 'label'=>'2024'],
            ['value'=>'2025', 'label'=>'2025'],
            ['value'=>'2026', 'label'=>'2026'],
            ['value'=>'2027', 'label'=>'2027'],
            ['value'=>'2028', 'label'=>'2028'],
            ['value'=>'2029', 'label'=>'2029']
        ];
    }

}