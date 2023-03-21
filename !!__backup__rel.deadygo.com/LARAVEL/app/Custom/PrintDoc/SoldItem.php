<?php

namespace App\Custom\PrintDoc;

/**
 * -------- Sold -----------
 * Used for managing solItems in class Invoice (for collecting invoice data needed for the printed version)
 */
class SoldItem
{
    public $name;
    public $amount;
    public $price;

    function __construct($name, $amount, $price)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
    }
}
