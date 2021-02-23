<?php


namespace HBLPay\Model;


use HBLPay\Common\LoadParamsFromArray;

/**
 * Class ShippingDetail
 *
 * @package HBLPay\Model
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class ShippingDetail extends LoadParamsFromArray
{
    /**
     * Name of the shipper
     *
     * @var string $NAME | Required
     */
    public $NAME;

    /**
     * Number of Days required by the merchant for delivery of the product
     *
     * @var string $DELIEVERY_DAYS | Optional
     */
    public $DELIEVERY_DAYS;

    /**
     * Cost of the shipment that will be deliver by the merchant
     *
     * @var string $SHIPPING_COST | Optional
     */
    public $SHIPPING_COST;
}