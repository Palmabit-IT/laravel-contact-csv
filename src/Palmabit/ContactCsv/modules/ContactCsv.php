<?php namespace Palmabit\ContactCsv\modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Palmabit\ContactCsv\exceptions\ConfigValueException;
use Palmabit\ContactCsv\services\ContactCsvServices;
use Palmabit\ContactCsv\traits\GetterTrait;

class ContactCsv {

  private $services;

  use GetterTrait;

  public function __construct() {
    $this->services = new ContactCsvServices();

  }

  public static function save(array $input) {
    $contactCsv = new ContactCsv();
    $contactCsv->appendCsv($input);

  }

  /**
   * @return mixed
   * @codeCoverageIgnore
   */
  public static function download() {
    $contactCsv = new ContactCsv();
    return Response::download($contactCsv->getPath(), basename($contactCsv->getPath()), ['Content-Type: text/csv']);
  }

  /**
   * @param array $input
   * @throws ConfigValueException
   * @codeCoverageIgnore
   */
  private function appendCsv(array $input) {
    if ($this->checkExistCsvFile()) {
      $this->services->save($input);
    } else {
      throw new ConfigValueException('');
    }

  }

  public function checkExistCsvFile() {
    return File::exists($this->getPath());
  }

}