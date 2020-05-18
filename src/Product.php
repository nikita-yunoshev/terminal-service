<?php

namespace TerminalService;

class Product
{
    /** @var string */
    protected string $code;

    /** @var float */
    protected float $price;

    /** @var array|null */
    protected ?array $discount;

    /**
     * Product constructor.
     * @param string $code
     * @param float $price
     * @param array $discount
     */
    public function __construct($code, $price, $discount = [])
    {
        $this->code     = $code;
        $this->price    = $price;
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
