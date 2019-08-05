<?php

/** 
 * Class for handling the final price of services
 */

class CalcServicePrice
{
    /**
     * @var string $serviceFee The fee of a service
     * @var 1 DELIVERY_SERVICE The delivery tag
     * @var 2 SELF_DELIVERY_SERVICE The self-delivery tag
     * @var 3 SELF_SERVICE The self-service tag
     * @var 4 WAITER_SERVICE The waiter-service tag
     * @var 0.10 DISCOUNT The amount of a discount
     * @var 0.10 SERVICE_FEE The fee for service
     * @var 200 DELIVERY_FEE The fee for delivery
     */

    private $serviceFee = '';

    const DELIVERY_SERVICE = 1;
    const SELF_DELIVERY_SERVICE = 2;
    const SELF_SERVICE = 3;
    const WAITER_SERVICE = 4;

    const DISCOUNT = 0.10;
    const SERVICE_FEE = 0.10;
    const DELIVERY_FEE = 200.00;

    public function __construct()
    {

    }

    /**
     * Decides whether a customer has picked any service provided
     * and applies or deducts the price of this service to/from
     * the total price
     * @param int $totalSum The total price of all the items
     * @param int $service The tag of a service
     * @return int
     */

    public function applyServiceFee(float $totalSum, int $service): float
    {
        if ($totalSum > 0) {

            if ($service === self::SELF_DELIVERY_SERVICE) {
        
                $this->serviceFee = number_format($totalSum * self::DISCOUNT, 2);

                return ($totalSum - $totalSum * self::DISCOUNT);
        
            } elseif ($service === self::WAITER_SERVICE) {
        
                $this->serviceFee = number_format($totalSum * self::SERVICE_FEE, 2);
        
                return ($totalSum + $totalSum * self::DISCOUNT);
        
            } elseif ($service === self::DELIVERY_SERVICE) { 

                $this->serviceFee = number_format(self::DELIVERY_FEE, 2);
                    
                return $totalSum + self::DELIVERY_FEE;
        
            } else {
                return $totalSum;
            };
        };
    }

    /**
     * Returns the string represantation of a service fee
     * @return string
     */

    public function getServiceFee(): string
    {
        return $this->serviceFee;
    }
}