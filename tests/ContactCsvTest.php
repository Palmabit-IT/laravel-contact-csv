<?php   namespace Palmabit\Tests;

use Palmabit\ContactCsv\modules\ContactCsv;

class ContactCsvTest extends TestCase {

  use ContactCsvStub;

  protected function getEnvironmentSetUp($app) {
    $app[ 'config' ]->set('ContactCsv::config.pathDataCsvFile', __DIR__ . '/data/data.csv');

  }

  /**
   * @test
   */
  public function checkExistCsvFile_test() {
    $contactCsv = new ContactCsv();
    $this->assertTrue($contactCsv->checkExistCsvFile());
  }

  /**
   * @test
   */
  public function testCanStaticallyInstanceContactCsv () {
      ContactCsv::save($this->contactStub());

  }

}
