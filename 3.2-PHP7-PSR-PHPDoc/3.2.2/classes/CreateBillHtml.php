<?php


/** 
 * Class for creating the HTML layout of a bill
 */

class CreateBillHtml
{

    /**
     * @var string $bill The HTML markup of a bill
     */

    private $bill = '';

    public function __construct()
    {

    }

    public function __destruct()
    {
        
    }

    /**
     * Sets the HTML element of a bill account
     * @param $billNum The number of a bill
     * @return void
     */

    public function setBillHtml($billNum): void
    {
        $this->bill .= $this->getBillHtml($billNum);
    }

    /**
     * Returns the HTML element of a bill account
     * @param $billNum The number of a bill
     * @return string
     */

    public function getBillHtml($billNum): string
    {
        return "<div class=\"order322-line order322-title\">
                    Счёт №$billNum
                </div>";
    }

    /**
     * Sets the HTML element of the final price of all the items chosen
     * @param array $itemsData The assoc array that contains data about the items
     * @return void
     */

    public function setItemsHtml(array $itemsData): void
    {
        $this->bill .= $this->getItemsHtml($itemsData);
    }

    /**
     * Returns the HTML element of the final price of all the items chosen
     * @param array $itemsData The assoc array that contains data about the items
     * @return string
     */

    public function getItemsHtml(array $itemsData): string
    {
        return
                "<div class=\"order322-line\">
                    <div>
                        {$itemsData['name']}
                    </div>
                    <div>
                        {$itemsData['amount']} * {$itemsData['price']} ₽ = {$itemsData['total']} ₽
                    </div>
                </div>";
    }

    /**
     * Sets the self-service HTML element
     * @uses $this->serviceFee
     * @uses $this->bill
     * @uses $this->service
     * @return void
     */

    public function setServiceHtml(string $serviceFee, int $service): void
    {
        if ($service === 2) {
    
            $this->bill .= $this->getSelfDeliveryServiceHtml($serviceFee);
    
        } elseif ($service === 4) {
    
            $this->bill .= $this->getWaiterServiceHtml($serviceFee);
    
        } elseif ($service === 1) { 
    
            $this->bill .= $this->getDeliveryServiceHtml($serviceFee);
    
        } else {
            $this->bill .= $this->getSelfServiceHtml();
        };
    }

    /**
     * Returns the self-service HTML element
     * @param int $serviceFee The fee for a service
     * @return string
     */

    public function getSelfDeliveryServiceHtml(string $serviceFee): string
    {
        return "<div class=\"order322-line\">
                    <div>
                        Скидка 10% (самовывоз)
                    </div>
                    <div>
                        - $serviceFee ₽
                    </div>
                </div>";
    }

    /**
     * Returns the waiter-service HTML element
     * @param int $serviceFee The fee for a service
     * @return string
     */

    public function getWaiterServiceHtml(string $serviceFee): string
    {
        return "<div class=\"order322-line\">
                    <div>
                        Чаевые 10%
                    </div>
                    <div>
                        $serviceFee ₽
                    </div>
                </div>";
    }

    /**
     * Returns the delivery-service HTML element
     * @param int $serviceFee
     * @return string
     */

    public function getDeliveryServiceHtml(string $serviceFee): string
    {
        return "<div class=\"order322-line\">
                    <div>Доставка</div>
                    <div>$serviceFee ₽</div>
                </div>";
    }

    /**
     * Returns the HTML element of the self-service
     * @return string
     */

    public function getSelfServiceHtml(): string
    {
        return '<div class=\"order322-line\">
                    Выбрано самообслуживание в кафе
                </div>';
    }

    /**
     * Returns the HTML element of the total price
     * @param int $totalSum The total sum of the whole purchase
     * @return string
     */
    
    public function getTotalPriceHtml(string $totalPrice): string
    {
        return "<div class=\"order322-total\">
                    <div>
                        Итого: $totalPrice ₽
                    </div>
                </div>";
    }

    /**
     * Sets the HTML element of the total price
     * @uses $this->bill
     * @return void
     */

    public function setTotalPriceHtml(string $totalPrice): void
    {
        $this->bill .= $this->getTotalPriceHtml($totalPrice);
    }

    /**
     * Outputs the HTML represantation of a bill
     * @uses $this->bill
     * @return string
     */

    public function getBill(): string
    {
        return $this->bill;
    }
}