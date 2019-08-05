<?php

/** 
 * Class for calculating the final price of the items
 */

class CalcItemsPrice
{
    private $menu;
    private $order;
    private $items = [];
    private $itemsSum = 0;
    
    /**
     * CalcItemsPrice constructor
     * @param array $menu A list of the items
     * @param array|null $order A list of the items chosen by a customer
     * @return void
     */

    public function __construct(array $menu = [], ?array $order = [])
    {
        $this->menu = $menu;
        $this->order = $order;
    }
    
    /**
     * Calculates the price of all the items chosen
     * @return void
     */

    private function getData(): void
    {
        foreach ($this->menu as $item) {

            $amount = $this->order[$item->id];
            
            if ($amount > 0) {
    
                $itemPrice = number_format($item->price, 2);
                $priceForItems = number_format($item->price * $amount, 2);

                $this->items[] = [
                    'name' => $item->name, 
                    'amount' => $amount, 
                    'price' => $itemPrice, 
                    'total' => $priceForItems
                ];
                
                $this->itemsSum += $item->price * $amount;
            };
        };
    }

    /**
     * Calls the getData function and returns an array of the associative arrays
     * of the items
     * @return array
     */

    public function getItemData(): array
    {
        $this->getData();
        return $this->items;
    }

    /**
     * Returns the total price of the items
     * @return float
     */

    public function getPriceForItems(): float
    {
        return $this->itemsSum;
    }
}