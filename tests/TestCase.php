<?php namespace Palmabit\Tests;

use Illuminate\Contracts\Console\Kernel;

class TestCase extends \Orchestra\Testbench\TestCase {

  protected function getPackageProviders($app) {
    return [
      'Palmabit\ContactCsv\ContactCsvServiceProvider',
    ];
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

}
