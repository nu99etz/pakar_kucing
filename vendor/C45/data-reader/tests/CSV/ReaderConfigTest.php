<?php

namespace Test\CSV;

use DataReader\CSV\ReaderConfig;
use DataReader\Exception\InvalidConfigException;
use PHPUnit\Framework\TestCase;

class ReaderConfigTest extends TestCase
{
    /**
     * @return \DataReader\CSV\ReaderConfig
     */
    private function getInstance()
    {
        return new ReaderConfig();
    }

    public function testSetLength()
    {
        $expected = 1000;
        $obj = $this->getInstance();
        $obj->setLength($expected);

        $actual = $obj->getLength();

        $this->assertEquals($expected, $actual);
        $this->assertNotEquals(null, $actual);
    }

    public function testSetLengthException()
    {
        $obj = $this->getInstance();
        $this->expectException(InvalidConfigException::class);
        $obj->setLength(-1);
    }

    public function testGetLength()
    {
        $obj = $this->getInstance();
        $expected = null;
        $actual = $obj->getLength();

        $this->assertEquals($expected, $actual);
    }

    public function testSetDelimiter()
    {
        $expected = '|';
        $obj = $this->getInstance();
        $obj->setDelimiter($expected);

        $actual = $obj->getDelimiter();

        $this->assertEquals($expected, $actual);
        $this->assertNotEquals(',', $actual);
    }
}
