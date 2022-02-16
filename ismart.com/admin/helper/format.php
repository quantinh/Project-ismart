<?php

#Hàm định dạng tiền tệ dạng vnđ
function currency_format($number, $suffix = 'đ'){
    return number_format($number).$suffix;
}

#Hàm định dạng thời gian d/m/y:D/M/S
function time_format($timestamp) {
    if (!empty($timestamp)) {
        $format = "%d/%m/%y %H:%M:%S";
        return strftime($format, $timestamp);
    }
}