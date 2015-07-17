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
    return $contactCsv->appendCsv($input);

  }

  /**
   * @param array $input
   * @throws ConfigValueException
   * @codeCoverageIgnore
   */
  public function appendCsv(array $input) {
    if ($this->checkExistCsvFile()) {
      $this->services->save($input);
    } else {
      throw new ConfigValueException('');
    }

  }

  public function checkExistCsvFile() {
    return File::exists($this->getPath());
  }

  /**
   * @return mixed
   * @codeCoverageIgnore
   */
  public static function downloadCsv() {
    return Response::download(self::getPath());
  }

}