<?php   namespace Palmabit\Tests;

use Palmabit\ContactCsv\modules\ContactCsv;

class ContactCsvTest extends TestCase {

  use ContactCsvStub;

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
