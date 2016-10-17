<?php namespace Palmabit\Tests;

use Illuminate\Contracts\Console\Kernel;
use ReflectionClass;

class TestCase extends \Orchestra\Testbench\TestCase {

  protected function getPackageProviders($app) {
    return [
      'Palmabit\ContactCsv\ContactCsvServiceProvider',
    ];
  }

  protected function getEnvironmentSetUp($app) {
    $app[ 'config' ]->set('contactcsv.pathDataCsvFile', __DIR__ . '/data/data.csv');
  }

  public function setUp () {
    if (! $this->app) {
      $this->refreshApplication();
    }
    $this->cleanData();
  }

  protected function cleanData () {
    file_put_contents(__DIR__ . '/data/data.csv', '');
  }

  /**
   * @test
   */
  public function test() {
    $this->assertTrue(true);
  }


  public function getPrivateMethod($class,$method)
  {
    $class = new ReflectionClass(get_class($class));
    $method = $class->getMethod($method);
    $method->setAccessible(true);
    return $method;
  }

}
