<?php namespace Palmabit\Tests;

use Faker\Factory;
use Palmabit\ContactCsv\services\ContactCsvServices;

class ContactCsvServicesTest extends TestCase {

  protected function getEnvironmentSetUp($app) {
    $app[ 'config' ]->set('ContactCsv::config.pathDataCsvFile', __DIR__ . '/data/data.csv');

  }

  /**
   * @test
   */
  public function append_test_checkIfPassedEmptyInput() {
    $service = new ContactCsvServices();
    $service->append(['name' => 'lorem', 'surname' => 'ipsum', 'email' => 'sit@sit.com']);

  }

  /**
   * @test
   */
  public function append_test() {
    $service = new ContactCsvServices();
    $service->append([]);
  }

  /**
   * @test
   */
  public function checkHeaderExist_test_assertFalse() {
    $service = new ContactCsvServices();
    $csvFake = ['lorem,ipsum,sit@sit.com'];
    $this->assertFalse($service->checkHeaderExist($csvFake));
  }

  /**
   * @test
   */
  public function checkHeaderExist_test_assertTrue() {
    $service = new ContactCsvServices();
    $csvFake = ['name,surname,email', 'lorem,ipsum,sit@sit.com'];
    $this->assertTrue($service->checkHeaderExist($csvFake));
  }

  /**
   * @test
   * @throws \Palmabit\ContactCsv\exceptions\ExistKeyException
   * @expectedException \Palmabit\ContactCsv\exceptions\ExistKeyException
   */
  public function uniqueKey_test_itThrowException() {
    $service = new ContactCsvServices();
    $csv     = ['name,surname,email', 'lorem,ipsum,dolor@dolor.com'];
    $input   = ['email' => 'dolor@dolor.com'];
    $service->uniqueKey($csv, $input);
  }

  /**
   * @test
   */
  public function uniqueKey_test() {
    $faker   = Factory::create();
    $data    = $faker->name . ',' . $faker->lastName . ',' . $faker->email;
    $service = new ContactCsvServices();
    $csv     = ['name,surname,email', $data];
    $input   = ['email' => 'dolor@dolor.com'];
    $service->uniqueKey($csv, $input);
  }

  /**
   * @test
   */
  public function uniqueKey_test_checkIfIntoInputNotExistKey() {
    $faker   = Factory::create();
    $data    = $faker->name . ',' . $faker->lastName . ',' . $faker->email;
    $service = new ContactCsvServices();
    $csv     = ['name,surname,email', $data];
    $input   = ['hello' => 'dolor@dolor.com'];
    $service->uniqueKey($csv, $input);
  }

  /**
   * @test
   */
  public function save_test() {
    $faker   = Factory::create();
    $input   = ['name' => $faker->name, 'surname' => $faker->lastName, 'email' => $faker->email];
    $service = new ContactCsvServices();
    $service->save($input);
    $file        = file(__DIR__ . '/data/data.csv');
    $csvLastData = explode(',', array_pop($file));
    $this->assertEquals($input[ 'name' ], trim($csvLastData[ 0 ]));
    $this->assertEquals($input[ 'surname' ], trim($csvLastData[ 1 ]));
    $this->assertEquals($input[ 'email' ], trim($csvLastData[ 2 ]));

  }

}
