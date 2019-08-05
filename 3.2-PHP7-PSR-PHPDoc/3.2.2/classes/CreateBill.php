<?php 

require_once 'CreateBillHtml.php';
require_once 'CalcServicePrice.php';
require_once 'CalcItemsPrice.php';
require_once 'CalcTotalPrice.php';

/** 
 * Class for creating a new bill
 * @version 1.1
 */

class CreateBill
{
    /**
     * @var int $billNumber The random number of a bill
     * @var 1000 MIN_BILL_NUM The minimal number of a bill
     * @var 9999 MAX_BILL_NUM The maximal number of a bill
     */

    private $billNumber = 0;

    const MIN_BILL_NUM = 1000;
    const MAX_BILL_NUM = 9999;

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
        if ($order!==null || $order!==[]) {
            $this->html = new CreateBillHtml;
            $this->items = new CalcItemsPrice($menu, $order);
            $this->service = new CalcServicePrice;
            $this->totalPrice = new CalcTotalPrice;
            $this->initWorkings($order);
        };
    }

    /**
     * Initiates the procedures
     * @return void
     */

    private function initWorkings($order): void
    {
        $this->genBillNum();
        $this->handleBillNum();
        $this->handleItems();
        $this->handleServices((int) $order['service']);
        $this->handleTotalPrice();
    }

    /**
     * Generates a unique account for a bill
     * @return void
     */

    private function genBillNum(): void
    {
        $this->billNumber = random_int(self::MIN_BILL_NUM, self::MAX_BILL_NUM);
    }

    /**
     * Handles the bill number
     * @return void
     */

    private function handleBillNum(): void
    {
        $this->genBillNum();
        $this->html->setBillHtml($this->billNumber);
    }

    /**
     * Handles the items
     * @return void
     */

    private function handleItems(): void
    {
        $itemsData = (array) $this->items->getItemData();

        foreach ($itemsData as $key => $itemData) {
            $this->html->setItemsHtml($itemData);
        };

        $priceForItems = $this->items->getPriceForItems();
        $this->totalPrice->incTotalPrice($priceForItems);
    }

    /**
     * Handles the services
     * @return void
     */

    private function handleServices($serviceTag): void
    {
        $totalPrice = $this->totalPrice->getTotalPrice();

        $newTotalPrice = $this->service->applyServiceFee($totalPrice, $serviceTag);
        $this->totalPrice->refreshTotalPrice($newTotalPrice);

        $serviceFee = $this->service->getServiceFee();
        $this->html->setServiceHtml($serviceFee, $serviceTag);
    }

    /**
     * Handles the total price
     * @return void
     */

    private function handleTotalPrice(): void
    {
        $formattedPrice = $this->totalPrice->formateTotalPrice();
        $this->html->setTotalPriceHtml($formattedPrice);
    }

    public function getBill(): string
    {
        return $this->html->getBill();
    }
}