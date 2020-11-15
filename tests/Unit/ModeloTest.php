<?php

namespace Bleez\Modelo\Test\Unit;

class ModeloTest extends \PHPUnit\Framework\TestCase
{
    protected $objectHelper;

    public function setUp()
    {
        $this->objectHelper = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
    }

    public function test_Deve_Retornar_True()
    {
        $this->assertTrue(true);
    }
}
