<?php

function number_format_custom($number, $decimals = 0, $dec_point = '.', $thousands_sep = ' ')
{
    return number_format($number, $decimals, $dec_point, $thousands_sep);
}
