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
In general, using the application involves working with two types of documents and balancing them. Since the program is designed for a small business, it makes sense to distinguish between clients to whom products are sold and invoiced (revenues) and clients from whom products are purchased (expenses).

Hence, the first group is customers (related to revenues) and the second group is contractors (related to expenses).

### Customers / contractors
There are separate pages for both groups, where their list is presented. There are also options for editing and creating the appropriate type of document (Add Rev. / Add Exp.)

### Revenues
Documentation of new revenue is to add revenue for the selected customer (list on the Customers page). This document contains data from the application, customer data and a list of added items with their quantity and price.

While adding new revenue, the program automatically displays the documents created in a given month, suggesting the next free number for an invoice.

### Expenses
Documentation of new expense is similar, but with a selected contractor (list on the Contractors page). In contrast to the revenue, the expense document contains only the total value in addition to the contractors data.

### Balance sheets
The reports page provides an overview of the total, annual and monthly balance sheet, where you can access all created documents, edit them and preview/print to PDF invoices (for revenues only).

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
