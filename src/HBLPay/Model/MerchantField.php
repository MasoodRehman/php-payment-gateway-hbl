<?php


namespace HBLPay\Model;


use HBLPay\Common\LoadParamsFromArray;

/**
 * Class MerchantField
 *
 * @package HBLPay\Model
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class MerchantField extends LoadParamsFromArray
{
    /**
     * Channel of Operation
     *
     * enum: WC
     *
     * @var string optional
     */
    public $MDD1;

    /**
     * 3D Secure Registration
     *
     * enum: YES, NO
     *
     * @var string optional
     */
    public $MDD2;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD3;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD4;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD5;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD6;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD7;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD8;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD9;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD10;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD11;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD12;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD13;

    /**
     * Date of Booking
     *
     * enum: DD-MM-YY hh:mm
     *
     * @var string optional
     */
    public $MDD14;

    /**
     * Check In Date
     *
     * enum: DD-MM-YY hh:mm
     *
     * @var string optional
     */
    public $MDD15;

    /**
     * Check Out Date
     *
     * enum: DD-MM-YY hh:mm
     *
     * @var string optional
     */
    public $MDD16;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD17;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD18;

    /**
     * N/A
     *
     * @var string optional
     */
    public $MDD19;

    /**
     * VIP Customer
     *
     * enum: YES, NO
     *
     * @var string optional
     */
    public $MDD20;
}