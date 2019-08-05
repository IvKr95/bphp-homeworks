<?php

/** 
 * Class for handling the final price of the items and services
 */

class CalcTotalPrice
{
    /**
     * @var int $totalPrice The final price
     */

    private $totalPrice;

    /**
     * CalcTotalPrice constructor
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * CalcTotalPrice destructor
     * @return void
     */

    public function __destruct()
    {
        
    }

    /**
     * Adds a value to the totalPrice
     * @param int $value A value to add
     * @return void
     */

    public function incTotalPrice(float $value): void
    {
        $this->totalPrice += floatval($value);
    }

    /**
     * Subtracts a value from the totalPrice
     * @param int $value A value to subtract
     * @return void
     */

    public function subTotalPrice(float $value): void
    {
        $this->totalPrice -= floatval($value);
    }

    /**
     * Refreshes the totalPrice with a value
     * @param int $value Overrides the totalPrice
     * @return void
     */

    public function refreshTotalPrice(float $value): void
    {
        $this->totalPrice = $value;
    }

    /**
     * Return the totalPrice
     * @return int
     */

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
    
    /**
     * Formates the totalPrice and returns it
     * @return string
     */

    public function formateTotalPrice(): string
    {
        return number_format($this->totalPrice, 2);
    }
}