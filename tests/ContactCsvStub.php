<?php

namespace Palmabit\Tests;

use Faker\Factory;

trait ContactCsvStub {

  /**
   * @return array
   */
  public function contactStub() {
    $faker = Factory::create();
    $input = ['name' => $faker->name, 'surname' => $faker->lastName, 'email' => $faker->email];
    return $input;
  }

} 