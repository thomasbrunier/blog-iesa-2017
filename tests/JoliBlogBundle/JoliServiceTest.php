<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as TestCase;

class JoliServiceTest extends TestCase
{
    private $container;

    public function setUp()
    {
        static::bootKernel();
        $this->container = static::$kernel->getContainer();
    }

    public function testConcatenateWithSpace()
    {
        $joliService = $this->container->get('joli.joli_service');

        $result = $joliService->concatenateWithSpace('Hello', 'World');

        $this->assertEquals('Hello World', $result);
    }
}
