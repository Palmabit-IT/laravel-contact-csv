<?php   namespace Palmabit\Tests;

use Palmabit\ContactCsv\modules\ContactCsv;

class ContactCsvTest extends TestCase {


	protected function getEnvironmentSetUp($app)
	{

			$app['config']->set('ContactCsv::config.pathDataCsvFile',__DIR__.'/data/data.csv');

	}

	/**
	 * @test
	 *
	 */
	public function checkExistCsvFile_test()
	{
		$module = new ContactCsv();
		$this->assertTrue($module->checkExistCsvFile());
	}

	/**
	 * @test
	 *
	 */
	public function checkAutocreate_test()
	{
		$module = new ContactCsv();
		$this->assertFalse($module->checkAutocreate());
	}
}
