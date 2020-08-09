<?php

namespace Quince\PersianGD\Contracts;

interface StringDecorator
{
    /**
     * Decorate given (persian) string and prepare it for gd.
     *
     * @param string $string
     * @param bool   $localNumbers
     * @param bool   $rtl
     *
     * @return string
     */
    public function decorate($string, $localNumbers = true, $rtl = true);
}
