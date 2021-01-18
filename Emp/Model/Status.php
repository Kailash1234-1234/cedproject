<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Model;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const STATUS_TEXTSELECT = 'select';
    const STATUS_TEXT = 'text';
    const STATUS_TEXTAREA = 'textarea';
    const STATUS_TEXTDATE = 'date';
    const STATUS_VARCHAR = 'varchar';
    const STATUS_STATIC = 'static';
    const STATUS_DATETIME = 'datetime';
    const STATUS_INT = 'int';
    const STATUS_DECIMAL = 'decimal';

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

    public function toDataTypeArray()
    {
        return [
            [
                self::STATUS_TEXT => __('TEXT FIELD'),
                self::STATUS_TEXTAREA => __('TEXT AREA'),
                self::STATUS_TEXTDATE=> __('DATE'),
                self::STATUS_TEXTSELECT=> __('SELECT BOX'),
               
            ],
        ];
    }

    public static function getDataTypeArray()
    {
        return [
            self::STATUS_TEXT => __('TEXT FIELD'),
                self::STATUS_TEXTAREA => __('TEXT AREA'),
                self::STATUS_TEXTDATE=> __('DATE'),
                self::STATUS_TEXTSELECT=> __('SELECT BOX'),
        ];
    }

    public static function toBackendTypeArray(){
        return [
                self::STATUS_TEXT => __('TEXT'),
                self::STATUS_TEXTDATE => __('DATETIME'),
                self::STATUS_VARCHAR => __('VARCHAR'),
                self::STATUS_STATIC =>__('STATIC'),
                self::STATUS_INT => __('INTEGER'),
                self::STATUS_DECIMAL => __('DECIMAL'),
        ];
    }
    public static function getBackendTypeArray(){
        return [
            self::STATUS_TEXT => __('TEXT'),
            self::STATUS_TEXTDATE => __('DATETIME'),
            self::STATUS_VARCHAR => __('VARCHAR'),
            self::STATUS_STATIC =>__('STATIC'),
            self::STATUS_INT => __('INTEGER'),
            self::STATUS_DECIMAL=> __('DECIMAL'),
        ];
    }

}