<?php

namespace TerminalService\Tests;

use PHPUnit\Framework\TestCase;
use TerminalService\Terminal;

class TerminalTest extends TestCase
{
    private Terminal $terminal;

    public function setUp(): void
    {
        $this->terminal = new Terminal();
        $this->terminal->setPricing('ZA', 2.00, [
            'count' => 4,
            'value' => 7
        ]);
        $this->terminal->setPricing('YB', 12.00);
        $this->terminal->setPricing('FC', 1.25, [
            'count' => 6,
            'value' => 6
        ]);
        $this->terminal->setPricing('GD', 0.15);
    }

    public function testSetPricing1()
    {
        $data = ['ZA', 'YB', 'FC', 'GD', 'ZA', 'YB', 'ZA', 'ZA'];
        $this->scanItems($data);

        $total = $this->terminal->getTotal();

        $this->assertEquals(32.4, $total);
    }

    public function testSetPricing2()
    {
        $data = ['FC', 'FC', 'FC', 'FC', 'FC', 'FC', 'FC'];
        $this->scanItems($data);


        $total = $this->terminal->getTotal();

        $this->assertEquals(7.25, $total);
    }

    public function testSetPricing3()
    {
        $data = ['ZA', 'YB', 'FC', 'GD'];
        $this->scanItems($data);


        $total = $this->terminal->getTotal();

        $this->assertEquals(15.40, $total);
    }

    private function scanItems($data)
    {
        foreach ($data as $item) {
            $this->terminal->scanItem($item);
        }
    }
}