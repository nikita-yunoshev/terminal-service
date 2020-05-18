<?php

namespace TerminalService;

use Error;
use TerminalService\ShoppingCart\ShoppingCart;

class Terminal
{
    /** @var array */
    private array $shoppingCarts;

    /** @var array */
    private array $productPool;

    /**
     * Terminal constructor.
     */
    public function __construct()
    {
        $this->shoppingCarts[] = new ShoppingCart();
        $this->productPool     = [];
    }

    /**
     * @return array
     */
    public function getShoppingCarts(): array
    {
        return $this->shoppingCarts;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->productPool;
    }

    /**
     * @param string $code
     * @param float $price
     * @param null|array $discount
     */
    public function setPricing($code, $price, $discount = null): void
    {
        if (array_key_exists($code, $this->productPool)) {
            $this->productPool[$code]->quantity += 1;

            return;
        }

        $this->productPool[$code] = new Product($code, $price, $discount);
    }

    /**
     * @param string $code
     * @param null|int $shoppingCartId
     */
    public function scanItem($code, $shoppingCartId = null): void
    {
        $shoppingCart = $this->getShoppingCartById($shoppingCartId);
        $product      = $this->getProduct($code);

        $shoppingCart->addItem($product);
    }

    /**
     * @param null|int $shoppingCartId
     * @return float
     */
    public function getTotal($shoppingCartId = null): float
    {
        $shoppingCart = $this->getShoppingCartById($shoppingCartId);

        return $shoppingCart->getTotalPrice();
    }

    /**
     * @param int|null $shoppingCartId
     * @return ShoppingCart|null
     */
    private function getShoppingCartById($shoppingCartId)
    {
        if (! $shoppingCartId) {
            return reset($this->shoppingCarts);
        }

        if (array_key_exists($shoppingCartId, $this->shoppingCarts)) {
            return $this->shoppingCarts[$shoppingCartId];
        }

        throw new Error('The shopping cart with the ID ' . $shoppingCartId . ' has not been found.');
    }

    /**
     * @param string $code
     * @return mixed
     */
    private function getProduct($code)
    {
        if (! array_key_exists($code, $this->productPool)) {
            throw new Error('The product with the code ' .  $code . ' has not been found.');
        }

        return $this->productPool[$code];
    }
}
