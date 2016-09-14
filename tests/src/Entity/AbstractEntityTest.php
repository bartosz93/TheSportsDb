<?php

namespace TheSportsDb\Test\Entity;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-06 at 13:17:19.
 */
abstract class AbstractEntityTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var \TheSportsDb\Entity\EntityInterface
   */
  protected $entity;

  /**
   * @var array
   */
  protected $getters;
  /**
   * @var array
   */
  protected $testValues;


  /**
   * @var string
   */
  protected $entityClass;

  protected function setUp() {
    $this->initGetters();
    $this->initTestValues();
    $this->entity = new $this->entityClass($this->testValues);
  }

  protected function initGetters() {
    $reflection = new \ReflectionClass($this->entityClass);
    foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
      if (strpos($method->getName(), 'get') === 0 && $method->getNumberOfParameters() === 0 && !$method->isStatic()) {
        $prop = lcfirst(substr($method->getName(), 3));
        $this->getters[$prop] = $method->getName();
      }
    }
  }

  protected function initTestValues() {
    $this->testValues = new \stdClass();
    if ($this->getters) {
      foreach (array_keys($this->getters) as $property) {
        $this->testValues->{$property} = $this->getTestValue();
      }
    }
  }

  protected function getTestValue($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->entity = NULL;
    $this->testValues = NULL;
    $this->getters = NULL;
    $this->entityClass = NULL;
  }

  protected function _testGetter($getter, $expected) {
    $this->assertEquals($expected, $this->entity->{$getter}());
  }

  public function testGetters() {
    foreach ($this->getters as $prop => $getter) {
      $this->_testGetter($getter, $this->testValues->{$prop});
    }
  }

}
