<?php namespace Palmabit\Tests;

use Faker\Factory;
use Palmabit\ContactCsv\services\ContactCsvServices;

class ContactCsvServicesTest extends TestCase {

  use ContactCsvStub;

  /**
   * @test
   */
  public function testHeaderExist() {
    $service          = new ContactCsvServices();
    $csvFake_noheader = ['lorem,ipsum,sit@sit.com'];
    $csvFake          = ['name,surname,email', 'lorem,ipsum,sit@sit.com'];

    $this->assertFalse($service->checkHeaderExist($csvFake_noheader));
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
    $service->keyExist($csv, $input);
  }

  /**
   * @test
   */
  public function testUniqueKeyExist() {
    $faker   = Factory::create();
    $data    = $faker->name . ',' . $faker->lastName . ',' . $faker->email;
    $service = new ContactCsvServices();
    $csv     = ['name,surname,email', $data];
    $input   = ['email' => 'dolor@dolor.com'];
    $service->keyExist($csv, $input);
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
    $service = new ContactCsvServices();
    $service->save($input);
    $file        = file(__DIR__ . '/data/data.csv');
    $csvLastData = explode(',', array_pop($file));

    $this->assertEquals($input[ 'name' ], trim($csvLastData[ 0 ]));
    $this->assertEquals($input[ 'surname' ], trim($csvLastData[ 1 ]));
    $this->assertEquals($input[ 'email' ], trim($csvLastData[ 2 ]));
  }

}
