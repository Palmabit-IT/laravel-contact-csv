<?php namespace Palmabit\ContactCsv\services;

use Illuminate\Support\Facades\File;
use Palmabit\ContactCsv\exceptions\ConfigValueException;
use Palmabit\ContactCsv\exceptions\KeyExistException;
use Palmabit\ContactCsv\traits\GetterTrait;

class ContactCsvServices {
  use GetterTrait;

  public function save(array $input) {
    $fp = fopen($this->getPath(), 'a');
    if ($fp) {
      $csv = file($this->getPath());

      $this->checkOrWriteHeader($csv);
      $this->keyExist($csv, $input);
      $this->append($input);
    }
  }

  /**
   * @param $csv
   * @return mixed
   * @codeCoverageIgnore
   */
  private function checkOrWriteHeader($csv) {
    if (!$this->checkHeaderExist($csv)) {
      $this->writeHeader();
    }

  }

  public function checkHeaderExist($csv) {
    $headerCsvFile = $this->getHeader($csv);
    $header        = $this->getFieldsArray();

    sort($header);
    sort($headerCsvFile);

    return $header === $headerCsvFile;
  }

  /**
   * @throws ConfigValueException
   * @codeCoverageIgnore
   */
  private function writeHeader() {
    File::prepend($this->getPath(), implode($this->getDelimitator(), $this->getFieldsArray()) . "\n");
  }

  /**
   * @param $csv
   * @param $input
   * @throws KeyExistException
   */
  public function keyExist($csv, $input) {
    $header   = $this->getHeader($csv);
    $indexKey = array_search($this->getFieldKey(), $header);
    foreach ($csv as $singleRowCsv) {
      $arrayRow = explode(',', $singleRowCsv);
      if (array_key_exists($this->getFieldKey(), $input)) {
        if (trim($arrayRow[ $indexKey ]) == $input[ $this->getFieldKey() ]) {
          throw new KeyExistException;
        }
      }
    }

  }

  /**
   * @param $input
   */
  public function append($input) {
    $data = [];
    foreach ($this->getFieldsArray() as $index => $field) {
      if (array_key_exists($field, $input)) {
        $data[ $field ] = $input[ $field ];
      }
    }
    if (!empty($data)) {
      File::append($this->getPath(), implode($this->getDelimitator(), $data) . "\n");
    }

  }

  /**
   * @param $csv
   * @return array
   */
  public function getHeader($csv) {
    $header = explode(',', trim(reset($csv)));
    return $header;
  }

}
