<?php


namespace HBLPay\Model;


use HBLPay\Common\LoadParamsFromArray;

/**
 * Class Order Summary
 *
 * @package HBLPay\Model
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class Order extends LoadParamsFromArray
{
    /**
     * Discount offered on the total amount charged by the merchant
     *
     * @var string $DISCOUNT_ON_TOTAL | Required
     */
    public $DISCOUNT_ON_TOTAL;

    /**
     * Total amount of order placed by the customer
     *
     * @var string $DISCOUNT_ON_TOTAL | Required
     */
    public $SUBTOTAL;

    /**
     * List of items. Order Summary Description
     *
     * @var array<Item> $OrderSummaryDescription | Required
     */
    public $OrderSummaryDescription = [];
}