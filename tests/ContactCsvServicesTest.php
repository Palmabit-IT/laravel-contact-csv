<?php namespace Palmabit\Tests;

use Faker\Factory;
use Palmabit\ContactCsv\services\ContactCsvServices;

class ContactCsvServicesTest extends TestCase {

  use ContactCsvStub;

  protected  $service;
  public function setUp()
  {
    parent::setUp();

    $this->service = new ContactCsvServices();
  }
  /**
   * @test
   */
  public function testHeaderExist() {
    $csvFake_noheader = ['lorem,ipsum,sit@sit.com'];
    $csvFake          = ['name,surname,email', 'lorem,ipsum,sit@sit.com'];

    $checkHeaderExist = $this->getPrivateMethod($this->service,"checkHeaderExist");

    $this->assertFalse($checkHeaderExist->invokeArgs($this->service,[$csvFake_noheader]));
    $this->assertTrue($checkHeaderExist->invokeArgs($this->service,[$csvFake]));

  }

  /**
   * @test
   * @throws \Palmabit\ContactCsv\exceptions\KeyExistException
   * @expectedException \Palmabit\ContactCsv\exceptions\KeyExistException
   */
  public function uniqueKey_test_itThrowException() {

    $csv     = ['name,surname,email', 'lorem,ipsum,dolor@dolor.com'];
    $input   = ['email' => 'dolor@dolor.com'];

    $this->service->keyExist($csv, $input);
  }

  /**
   * @test
   */
  public function testUniqueKeyExist() {
    $faker   = Factory::create();
    $data    = $faker->name . ',' . $faker->lastName . ',' . $faker->email;

    $csv     = ['name,surname,email', $data];
    $input   = ['email' => 'dolor@dolor.com'];

    $this->service->keyExist($csv, $input);
  }

  /**
   * @test
   */
  public function testNotThrownExceptionIfKeyNotExist() {
    $faker   = Factory::create();
    $data    = $faker->name . ',' . $faker->lastName . ',' . $faker->email;
    $service = new ContactCsvServices();
    $csv     = ['name,surname,email', $data];
    $input   = ['hello' => 'dolor@dolor.com'];
    $service->keyExist($csv, $input);
  }

  /**
   * @test
   */
  public function save_test() {
    $input   = $this->contactStub();

    $this->service->save($input);

    $file        = file(__DIR__ . '/data/data.csv');
    $csvLastData = explode(',', array_pop($file));

    $this->assertEquals($input[ 'name' ], trim($csvLastData[ 0 ]));
    $this->assertEquals($input[ 'surname' ], trim($csvLastData[ 1 ]));
    $this->assertEquals($input[ 'email' ], trim($csvLastData[ 2 ]));
  }

}
