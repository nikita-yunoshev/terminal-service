<?php

namespace TerminalService\ShoppingCart;

use TerminalService\Product;

class Item extends Product
{
    /** @var int */
    public int $quantity = 1;

    /**
     * Item constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product->code, $product->price, $product->discount);
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        if (empty($this->discount)) {
            return $this->price * $this->quantity;
        }

        if ($this->discount['count'] == $this->quantity) {
            return $this->discount['value'];
        }

        $intDivision = intdiv($this->quantity, $this->discount['count']);

        if ($intDivision === 0) {
            return $this->price * $this->quantity;
        }

        return $intDivision * $this->discount['value'] + $this->price * $intDivision;
    }
}
