<?php

namespace CafeMedia\Feature\Tests;

use CafeMedia\Feature\World\Mobile;

/**
 * Class MobileTest
 * @package CafeMedia\Feature\Tests
 */
class MobileTest extends \PHPUnit_Framework_TestCase
{
    private $mobile;

    public function setUp()
    {
        $this->mobile = new Mobile(
            'test',
            1,
            $this->getMockBuilder('CafeMedia\Feature\Logger')->disableOriginalConstructor()->getMock()
        );
    }

    public function testUaid()
    {
        $this->assertEquals($this->mobile->uaid(), 'test');
    }

    public function testUserID()
    {
        $this->assertEquals($this->mobile->userID(), 1);
    }

    public function testGetLastName()
    {
        $this->assertEquals($this->mobile->getLastName(), null);

        $this->mobile->log('test', 'test', 'test');
        $this->assertEquals($this->mobile->getLastName(), 'test');

        $this->mobile->clearLastFeature();
        $this->assertEquals($this->mobile->getLastName(), null);
    }

    public function testGetLastVariant()
    {
        $this->assertEquals($this->mobile->getLastVariant(), null);

        $this->mobile->log('test', 'test', 'test');
        $this->assertEquals($this->mobile->getLastVariant(), 'test');

        $this->mobile->clearLastFeature();
        $this->assertEquals($this->mobile->getLastVariant(), null);
    }

    public function getLastSelector()
    {
        $this->assertEquals($this->mobile->getLastSelector(), null);

        $this->mobile->log('test', 'test', 'test');
        $this->assertEquals($this->mobile->getLastSelector(), 'test');

        $this->mobile->clearLastFeature();
        $this->assertEquals($this->mobile->getLastSelector(), null);
    }
}