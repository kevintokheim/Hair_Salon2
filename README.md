# _Hair Salon_

##### _Allows user to view and edit lists of stylists and clients, August 21, 2015_

#### By _**Kevin Tokheim**_

## Description

_This is an app which allows a user to view a list of stylists and add a stylist to the list. In addition, the user can view the client list of individual stylists and add their own clients to the list as well._

## Setup

* _Install Composer on your machine. In Windows, run the Composer Install from the Composer website. In Mac, run the composer install command in your terminal._
* _Run your php server by navigating into the web folder of this project and typing in your terminal "php -S localhost:8000."_
* _Download a MySql and Apache client. Start a MySql server by running the command mysql.server start. Log in with the command mysql -uroot -proot. In the Bash terminal, start Apache by typing apachectl._
* _Create a database called hair_salon in MySQL with the command CREATE DATABASE hair_salon. Type USE hair_salon and then SELECT DATABASE()._
* _Type CREATE TABLE stylist (id serial PRIMARY KEY, stylist_name varchar (255)); to create a stylist table with an id and stylist_name value._
* _Type CREATE TABLE client (id serial PRIMARY KEY, client_name varchar(255), stylist_id int); to create a client table with an id and client_name and stylist_id values.


## Technologies Used

_PHP, MySQL, Apache, PHPUnit, Silex, Twig_

### Legal

Copyright (c) 2015 **_Kevin Tokheim_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
