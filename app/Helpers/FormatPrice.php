<?php namespace App\Helpers;
class FormatPrice{
    public static function formatPrice($number)
    {
        $number=intval($number);
        return $number =number_format($number,0,',','.').'đ';
    }
}
