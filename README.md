<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# Revenue and Expense Ledger

This is quite simple, but very effective revenue and expense ledger, built according to polish tax law intended for small business with a small range of customers. It offers total, yearly and monthly balance of incomes/costs. REL provides also invoice creation including printing to PDF.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

## Usage
The main module of REL is Balance (Reports), the others are registers of customers/contractors and revenues/expenses.

### Total Balance
The total balance view contains all collected data with some global statistics.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

### Annual Balance
In the annual view monthly summaries are listed together.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

### Monthly Balance
The monthly balance provides direct access to all revenues and expenses in the given month. In this overview there is also editing and printing to PDF (for revenues only) possible.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

### Editing revenues/expenses
Expenses contain just values, while revenues are collections of items with given amount and price per unit.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

### Preview / Print to PDF
Invoices are created automatically and can be previewed or printed as PDF-files.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

### Customers / Contractors
Customers are those who buy products from us (related to revenues), while contractors are clients who sell to us (related to expenses).

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

## Architecture

The conversion provides class _NWConv_:

app \ Custom \ [NWConv.php](https://github.com/wie1900/conv/blob/main/app/Custom/NWConv.php)

The length of the input number can be extended by adding new values in the _$names_ array and changing validating rule in the controller to the appropriate value (currently: 30):

app \ Http \ Controllers \ [ConvController.php](https://github.com/wie1900/conv/blob/main/app/Http/Controllers/ConvController.php)

## What was used

- Laravel
- PHP
- SQLite
- Blade, HTML/CSS + Bootstrap
- Javascript (Vanilla)
- TCPDF (PDF creating)

## Working version

The working version (secured with auth of Laravel, user: _user@user.com_, password: _user_) is available at:

[https://rel.deadygo.com](https://rel.deadygo.com)
