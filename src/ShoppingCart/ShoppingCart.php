<?php

namespace TerminalService\ShoppingCart;

use Error;
use TerminalService\Product;

class ShoppingCart
{
    /** @var float */
    private float $total;

    /** @var array */
    private array $items;

    /**
     * ShoppingCart constructor.
     */
    public function __construct()
    {
        $this->items = [];
        $this->total = 0;
    }

    /**
     * @param string $code
     * @return Item|null
     */
    public function getItem($code): ?Item
    {
        return array_key_exists($code, $this->items) ? $this->items[$code] : null;
    }

    /**
     * @param Product $product
     */
    public function addItem(Product $product): void
    {
        $productCode = $product->getCode();
        $item        = $this->getItem($productCode);

        if (! $item) {
            $this->items[$productCode] = new Item($product);

            return;
        }

        $this->items[$productCode]->quantity += 1;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        if (empty($this->items)) {
            throw new Error('The shopping cart is empty');
        }

        foreach ($this->items as $item) {
            $this->total += $item->getTotalPrice();
        }

        return $this->total;
    }
}
