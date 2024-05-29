<?php


namespace HBLPay\Helper;


class CoreHelper
{
    /**
     * Data dumping.
     *
     * @param $data
     */
    public static function dd($data)
    {
        echo "<pre>"; print_r($data); die();
    }
}