<?php


namespace HBLPay\Model;


use HBLPay\Common\LoadParamsFromArray;

/**
 * Class Item - Order Summary Description
 *
 * @package HBLPay\Model
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class Item extends LoadParamsFromArray
{
    /**
     * Name of the specific item that customer placed the order
     *
     * @var string $ITEM_NAME | Required
     */
    public $ITEM_NAME;

    /**
     * Quantity of specific items
     *
     * @var string $QUANTITY | Required
     */
    public $QUANTITY;

    /**
     * Per Unit Price of the specific item
     *
     * @var string $UNIT_PRICE | Required
     */
    public $UNIT_PRICE;

    /**
     * Category of the specific item
     *
     * @var string $CATEGORY | Required
     */
    public $CATEGORY;

    /**
     * Sub Category of the specific item
     *
     * @var string $SUB_CATEGORY | Required
     */
    public $SUB_CATEGORY;
}