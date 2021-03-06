<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotInstanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validInstanceProvider
     */
    public function testValidInstanceShouldWork($object, $class)
    {
        $this->assertTrue(v::notInstance($class)->validate($object));
    }

    /**
     * @dataProvider invalidInstanceProvider
     */
    public function testInvalidInstanceShouldNotWork($object, $class)
    {
        $validator = v::notInstance($class);
        $this->assertFalse($validator->validate($object));

        $message = "The input must not be an instance of {$class}";
        $this->assertEquals($message, $validator->getViolation("notInstance"));

        $message = "The input should not be an instance of {$class}";
        $this->assertEquals($message, $validator->getViolation("notInstance", $message));
    }

    public function validInstanceProvider()
    {
        return array(
            array(array(), '\stdClass'),
            array("string", '\stdClass'),
            array(1234, '\stdClass')
        );
    }

    public function invalidInstanceProvider()
    {
        return array(
            array(new \Exception(), '\Exception'),
            array(new \DateTime(), '\DateTime'),
            array(new v(), 'Melody\Validation\Validator')
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::instance(new \stdClass());
    }
}
