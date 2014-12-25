<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Eav\Model\Entity\Increment;

class NumericTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Numeric
     */
    private $model;

    protected function setUp()
    {
        $this->model = new Numeric();
    }

    /**
     * @param int $lastId
     * @param string $prefix
     * @param int|string $expectedResult
     * @dataProvider getLastIdDataProvider
     */
    public function testGetNextId($lastId, $prefix, $expectedResult)
    {
        $this->model->setLastId($lastId);
        $this->model->setPrefix($prefix);
        $this->assertEquals($expectedResult, $this->model->getNextId());
    }

    public function getLastIdDataProvider()
    {
        return [
            [
                'lastId' => 1,
                'prefix' => 'prefix',
                'expectedResult' => 'prefix00000002',
            ],
            [
                'lastId' => 'prefix00000001',
                'prefix' => 'prefix',
                'expectedResult' => 'prefix00000002'
            ],
        ];
    }

    public function testGetPadLength()
    {
        $this->assertEquals(8, $this->model->getPadLength());
        $this->model->setPadLength(10);
        $this->assertEquals(10, $this->model->getPadLength());
    }

    public function getPadChar()
    {
        $this->assertEquals('0', $this->model->getPadChar());
        $this->model->setPadChar('z');
        $this->assertEquals('z', $this->model->getPadChar());
    }

    public function testFormat()
    {
        $this->model->setPrefix('prefix');
        $this->model->setPadLength(3);
        $this->model->setPadChar('z');
        $this->assertEquals('prefixzz1', $this->model->format(1));
    }

    public function testFrontendFormat()
    {
        $this->assertEquals('value', $this->model->frontendFormat('value'));
    }
}