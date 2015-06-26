<?php namespace Palmabit\Tests;

use Illuminate\Contracts\Console\Kernel;

class TestCase extends \Orchestra\Testbench\TestCase {

  protected function getPackageProviders($app) {
    return [
      'Palmabit\ContactCsv\ContactCsvServiceProvider',
    ];
  }

  /**
   * @test
   */
  public function test() {
    $this->assertTrue(true);
  }

}
