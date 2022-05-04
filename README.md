<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# Revenue and Expense Ledger

This is quite simple, but very effective revenue and expense ledger, built according to polish tax law intended for small business with a small range of customers. It offers total, yearly and monthly balance of incomes and costs and also provides invoice creation and printing to PDF.


## Screenshot
![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

## Usage
Insert any number with length 1-30 digits plus 1-2 digits separated by 'dot' for tenths and hundredths (optionally), e.g. 20 or 20.99 and click _Let convert_. To clear both input fields choose _Clear fields_.

## Architecture
The conversion provides class _NWConv_:

app \ Custom \ [NWConv.php](https://github.com/wie1900/conv/blob/main/app/Custom/NWConv.php)

The length of the input number can be extended by adding new values in the _$names_ array and changing validating rule in the controller to the appropriate value (currently: 30):

app \ Http \ Controllers \ [ConvController.php](https://github.com/wie1900/conv/blob/main/app/Http/Controllers/ConvController.php)

## Tests
The application has been tested using PHPUnit tests:

tests \ Feature \ [nvconvTest.php](https://github.com/wie1900/conv/blob/main/tests/Feature/nvconvTest.php)

## What was used

- Laravel
- PHP
- Bootstrap
- Javascript
- PHPUnit

## Working version

The working version is available at:

[https://conv.deadygo.com](https://conv.deadygo.com)
