<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# Revenue and Expense Ledger

This is quite simple, but very effective revenue and expense ledger, built according to polish tax law intended for small business with a small range of customers. It offers total, yearly and monthly balance of incomes/costs. REL provides also invoice creation including printing to PDF.

![home](https://user-images.githubusercontent.com/89514476/166691530-9c95d01c-b3be-4922-9c49-dce66e232545.gif)

## Usage
The main module of REL is Balance (Reports), the others are registers of customers/contractors and revenues/expenses.

### Total Balance
The total balance view contains all collected data with some global statistics.

![bal_total](https://user-images.githubusercontent.com/89514476/166805921-c9bfa9e0-6114-4581-ad24-cba988716980.gif)

### Annual Balance
In the annual view monthly summaries are listed together.

![bal_year](https://user-images.githubusercontent.com/89514476/166805980-6a0df15d-844b-43b4-96ab-f54eca8ffd37.gif)

### Monthly Balance
The monthly balance provides direct access to all revenues and expenses in the given month. In this overview there is also editing and printing to PDF (for revenues only) possible.

![bal_mon](https://user-images.githubusercontent.com/89514476/166806067-5d4cfc52-1109-479f-a8b6-6875dbb0d562.gif)

### Editing revenues/expenses
Expenses contain just values, while revenues are collections of items with given amount and price per unit.

![rev_edit](https://user-images.githubusercontent.com/89514476/166806113-d99a289e-e4d4-4f82-bdf0-f8f39f6218d6.gif)

### Preview / Print to PDF
Invoices are created automatically and can be previewed or printed as PDF-files.

![invoice](https://user-images.githubusercontent.com/89514476/166806186-d5b78ffa-087b-4ccf-bbe9-216dc3d9d33b.gif)

### Customers / Contractors
Customers are those who buy products from us (related to revenues), while contractors are clients who sell to us (related to expenses).

![customs](https://user-images.githubusercontent.com/89514476/166806237-2602ed68-79b2-46fa-9e0d-df14b73cdfd0.gif)

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
- Vanilla Javascript
- TCPDF

## Working version

The working version (secured with auth of Laravel, email: _user@user.com_, password: _user_) is available at:

[https://rel.deadygo.com](https://rel.deadygo.com)
