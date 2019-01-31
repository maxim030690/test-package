<?php

namespace Tkachev\Testing;

use tkachev\images\Images;
use PHPUnit\Framework\TestCase;

/**
 * Class ImagesTest
 */
class ImagesTest extends TestCase{


    /**
     * @var string
     */
    private $url = 'https://kor.ill.in.ua/m/610x386/2271658.jpg';


    /**
     * Test on true
     */
    function testTrue() {
        $images = new Images();
        $this->assertTrue($images->uploadImage($this->url));
    }
}

