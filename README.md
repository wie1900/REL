<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# Revenue and Expense Ledger

This revenue and expense ledger is built according to polish tax law intended for small business with a small range of customers. It offers total, yearly and monthly balance of incomes/costs. REL provides also invoice creation including printing to PDF.

![home](resources/assets/images/home.gif)

## Features

- Adding/editing customers and contractors
- Adding/editing revenues / expenses
- Automatic invoicing
- Printing to PDF
- Total/annual/monthly balance sheets

## Usage
The main module of REL is Balance Preview (Reports), the others are registers of customers/contractors and revenues/expenses.

## Screenshots

### Total Balance
The total balance view contains all collected data with some global statistics.

![bal_total](resources/assets/images/bal_total.gif)

### Annual Balance
In the annual view monthly summaries are listed together.

![bal_year](resources/assets/images/bal_year.gif)

### Monthly Balance
The monthly balance provides direct access to all revenues and expenses in the given month. In this overview there is also editing and printing to PDF (for revenues only) possible.

![bal_mon](resources/assets/images/bal_mon.gif)

### Editing revenues/expenses
Expenses contain just values, while revenues are collections of items with given amount and price per unit.

![rev_edit](resources/assets/images/rev_edit.gif)

### Preview / Print to PDF
Invoices are created automatically and can be previewed or printed as PDF-files.

![invoice](resources/assets/images/invoice.gif)

### Customers / Contractors
Customers are those who buy products from us (related to revenues), while contractors are clients who sell to us (related to expenses).

![customs](resources/assets/images/customs.gif)

## What was used

- Laravel 9
- PHP 8
- SQLite
- Blade, HTML/CSS + Bootstrap 5
- Vanilla Javascript
- TCPDF

## Working version

The working version (secured with auth of Laravel, email: _user@user.com_, password: _user_) is available at:

[https://rel.deadygo.com](https://rel.deadygo.com)
