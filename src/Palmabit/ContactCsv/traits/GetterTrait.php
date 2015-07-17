<?php namespace Palmabit\ContactCsv\traits;

use Palmabit\ContactCsv\exceptions\ConfigValueException;

trait GetterTrait {

  /**
   * @return mixed
   * @throws ConfigValueException
   */
  public function getPath() {
    if (!is_null($this->getConfig()[ 'pathDataCsvFile' ]) || !empty($this->getConfig()[ 'pathDataCsvFile' ])) {
      return $this->getConfig()[ 'pathDataCsvFile' ];
    } else {
      throw new ConfigValueException;
    }
  }

  /**
   * @return Config
   */
  public function getConfig() {
    return config('contactcsv');
  }

  /**
   * @return mixed
   */
  public function getFieldsArray() {
    return config('contactcsv.fields');
  }

  public function getFieldKey() {
    return config('contactcsv.key');
  }

  public function getDelimitator() {
    if (is_null($this->getConfig()[ 'delimitator' ]) || empty($this->getConfig()[ 'delimitator' ])) {
      return ',';
    }

    return $this->getConfig()[ 'delimitator' ];
  }
}