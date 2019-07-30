<?php 
/** 
 * Class for calculating the final price of the items and services
 * @version 1.0
 */

class Bill
{
    /**
     * @var array $menu A list of available items
     * @var array|null $order A list of the chosen items
     * @var int $totalSum The final price for all the items
     * @var string $bill An HTML representation of all the items 
     * @var int $billNumber The random number of a bill
     * @var int $service The service picked by a customer
     * @var int $serviceFee The fee of a service
     * @var 1000 MIN_BILL_NUM The minimal number of a bill
     * @var 9999 MAX_BILL_NUM The maximal number of a bill
     * @var 1 DELIVERY_SERVICE The delivery tag
     * @var 2 SELF_DELIVERY_SERVICE The self-delivery tag
     * @var 3 SELF_SERVICE The self-service tag
     * @var 4 WAITER_SERVICE The waiter-service tag
     * @var 0.10 DISCOUNT The amount of a discount
     * @var 0.10 SERVICE_FEE The fee for service
     * @var 200 DELIVERY_FEE The fee for delivery
     */

    protected $menu,
              $order,
              $totalSum = 0,
              $bill = '',
              $billNumber,
              $service,
              $serviceFee = 0;

    const MIN_BILL_NUM = 1000;
    const MAX_BILL_NUM = 9999;
    
    const DELIVERY_SERVICE = 1;
    const SELF_DELIVERY_SERVICE = 2;
    const SELF_SERVICE = 3;
    const WAITER_SERVICE = 4;

    const DISCOUNT = 0.10;
    const SERVICE_FEE = 0.10;
    const DELIVERY_FEE = 200.00;

    /**
     * Bill class constructor
     * @param array $menu 
     * The default value of $menu is []
     * @param array|null $order 
     * The default value of $order is []
     * @return void
     */

    public function __construct(array $menu = [], ?array $order = [])
    {
        $this->menu = $menu;
    
        if ($order!==null || $order!==[]) {
            $this->order = $order;
            $this->service = (int) $order['service'];
            $this->generateBillNum();
            $this->setBillHtml();
            $this->getPriceForItems();
            $this->getPriceForService();
            $this->setServiceHtml();
            $this->formateTotalPrice();
            $this->setTotalPriceHtml();
        };
    }

    /**
     * Generates a unique account for a bill
     * @return void
     */

    protected function generateBillNum(): void
    {
        $this->billNumber = random_int(self::MIN_BILL_NUM, self::MAX_BILL_NUM);
    }

    /**
     * Sets the HTML element of a bill account
     * @return string
     */

    protected function setBillHtml(): void
    {
        $this->bill .= $this->getBillHtml();
    }

    /**
     * Returns the HTML element of a bill account
     * @return string
     */

    protected function getBillHtml(): string
    {
        return '<div class=\"order322-line order322-title\">
                    Счёт №' . $this->billNumber . 
                '</div>';
    }

    /**
     * Calculates the final price of all the items chosen
     * @return void
     */

    protected function getPriceForItems(): void
    {
        foreach ($this->menu as $item) {

            $amount = $this->order[$item->id];
    
            if ($amount > 0) {
    
                $itemPrice = number_format($item->price, 2);
                $priceForItems = number_format($item->price * $amount, 2);
                
                $this->bill .= $this->getItemsHtml($item->name, $amount, $itemPrice, $priceForItems);
    
                $this->totalSum += $priceForItems;
            };
        };
    }

    /**
     * Returns the HTML element of the final price of all the items chosen
     * @param string $name The name of an item
     * @param int $amount The quantity of an item
     * @param int $itemPrice The price of an item
     * @param int $priceForItems The price of a total amount of the items
     * @return string
     */

    protected function getItemsHtml(string $name, int $amount, int $itemPrice, int $priceForItems): string
    {
        return
                "<div class=\"order322-line\">
                    <div>
                        $name
                    </div>
                    <div>
                        $amount * $itemPrice ₽ = $priceForItems ₽
                    </div>
                </div>";
    }

    /**
     * Decides whether a customer has picked any service provided
     * and applies or deducts the price of this service to/from
     * the total price
     * @return void
     */

    protected function getPriceForService(): void
    {
        if ($this->totalSum > 0) {

            if ($this->service === self::SELF_DELIVERY_SERVICE) {
        
                $this->serviceFee = number_format($this->totalSum * self::DISCOUNT, 2);

                $this->totalSum -= (float) $this->serviceFee;
        
            } elseif ($this->service === self::WAITER_SERVICE) {
        
                $this->serviceFee = number_format($this->totalSum * self::SERVICE_FEE, 2);
        
                $this->totalSum += (float) $this->serviceFee;
        
            } elseif ($this->service === self::DELIVERY_SERVICE) { 
                    
                $this->totalSum += self::DELIVERY_FEE;
        
            };
        };
    }

    /**
     * Sets the self-service HTML element
     * @uses $this->serviceFee
     * @uses $this->bill
     * @uses $this->service
     * @return string
     */

    protected function setServiceHtml(): void
    {
        if ($this->service === self::SELF_DELIVERY_SERVICE) {
    
            $this->bill .= $this->getSelfDeliveryServiceHtml();
    
        } elseif ($this->service === self::WAITER_SERVICE) {
    
            $this->bill .= $this->getWaiterServiceHtml();
    
        } elseif ($this->service === self::DELIVERY_SERVICE) { 
    
            $this->bill .= $this->getDeliveryServiceHtml();
    
        } else {
            $this->bill .= $this->getSelfServiceHtml();
        };
    }

    /**
     * Returns the self-service HTML element
     * @uses $this->serviceFee
     * @return string
     */

    protected function getSelfDeliveryServiceHtml(): string
    {
        return '<div class=\"order322-line\">
                    <div>
                        Скидка 10% (самовывоз)
                    </div>
                    <div>
                        - ' . $this->serviceFee . '₽
                    </div>
                </div>';
    }

    /**
     * Returns the waiter-service HTML element
     * @uses $this->serviceFee
     * @return string
     */

    protected function getWaiterServiceHtml(): string
    {
        return '<div class=\"order322-line\">
                    <div>
                        Чаевые 10%
                    </div>
                    <div>
                        ' . $this->serviceFee . ' ₽
                    </div>
                </div>';
    }

    /**
     * Returns the delivery-service HTML element
     * @uses self::DELIVERY_FEE
     * @return string
     */

    protected function getDeliveryServiceHtml(): string
    {
        return '<div class=\"order322-line\">
                    <div>Доставка</div>
                    <div>' . self::DELIVERY_FEE .' ₽</div>
                </div>';
    }

    /**
     * Returns the HTML element of self-service chosen
     * @return string
     */

    protected function getSelfServiceHtml(): string
    {
        return '<div class=\"order322-line\">
                    Выбрано самообслуживание в кафе
                </div>';
    }

    /**
     * Returns the HTML element of the total price
     * @uses $this->totalSum
     * @return string
     */
    
    protected function getTotalPriceHtml(): string
    {
        return '<div class=\"order322-total\">
                    <div>
                        Итого:' . $this->totalSum . ' ₽
                    </div>
                </div>';
    }

    /**
     * Sets the HTML element of the total price
     * @uses $this->bill
     * @return void
     */

    protected function setTotalPriceHtml(): void
    {
        $this->bill .= $this->getTotalPriceHtml();
    }

    /**
     * Formates the total price
     * @uses $this->totalSum
     * @return void
     */

    protected function formateTotalPrice(): void
    {
        $this->totalSum = number_format($this->totalSum, 2);
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