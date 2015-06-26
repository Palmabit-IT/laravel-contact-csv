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
    return config('ContactCsv::config');
  }

  /**
   * @return mixed
   */
  public function getAutocreate() {
    return $this->getConfig()[ 'autocreate' ];
  }

  /**
   * @return mixed
   */
  public function getFieldsConfig() {
    return config('ContactCsv::fields');
  }

  /**
   * @return mixed
   */
  public function getFieldsArray() {
    return $this->getFieldsConfig()[ 'fields' ];
  }

  public function getFieldKey() {
    return $this->getFieldsConfig()[ 'key' ];
  }

  public function getDelimitator() {
    if (is_null($this->getFieldsConfig()[ 'delimitator' ]) || empty($this->getFieldsConfig()[ 'delimitator' ])) {
      return ',';
    }

    return $this->getFieldsConfig()[ 'delimitator' ];
  }
}