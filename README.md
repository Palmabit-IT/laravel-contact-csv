# LaravelContactCSV

[![Build Status](https://travis-ci.org/Palmabit-IT/ContactCsv.svg?branch=master)](https://travis-ci.org/Palmabit-IT/ContactCsv)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Palmabit-IT/ContactCsv/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Palmabit-IT/ContactCsv/?branch=master)

 This Laravel package allows you to easily save contact data in CSV format.

## Installation

To install this package follow these instructions

1. `composer require laravel-contact-csv`
2. `add Palmabit\ContactCsv\ContactCsvServiceProvider to your config/app.php ServiceProviders`
3. `php artisan vendor:publish --provider="Palmabit\ContactCsv\ContactCsvServiceProvider"`
4. `create csv file and set the absolute path into configuration file: config/packages/Palmabit/ContactCsv/config.php`
5. `complete the second configuration file: config/packages/Palmabit/ContactCsv/field.php`


## Usage

###Save new row in csv file

```
$my_array = ['email'=>'dev@palmabit.com'];
ContactCsv::save($my_array);
```

###Download the csv file

```
ContactCsv::downloadCsv();
```

## Tests
You can run tests locally with

```
  phpunit
```

The build is continuously run on travis.

## Contributing

* Add tests for any new or changed functionality
* update doc

## Author

[palmabit.com](http://www.palmabit.com)


##License

LaravelContactCSV it's free and easy to integrate within your existing projects. [See the MIT License](http://opensource.org/licenses/MIT)


## Todo

• Setup/write/download more than one CSV file
