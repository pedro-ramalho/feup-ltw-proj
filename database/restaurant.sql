/*****************
  Database Script
******************/

/**************************************************************************

/* USER OF THE WEBSITE */
/* CAN BE BOTH A Customer OR A Restaurant Owner */

DROP TABLE IF EXISTS User; 


/* TYPES OF USERS */

DROP TABLE IF EXISTS RestaurantOwner;
DROP TABLE IF EXISTS Customer;


/* OTHERS */

DROP TABLE IF EXISTS BankAccount; /* for restaurant owners */
DROP TABLE IF EXISTS CreditCard;  /* for customer orders */
 
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Order;
DROP TABLE IF EXISTS Dish;

/**************************************************************************

/* CREATING TABLES */

CREATE TABLE User
(

);

CREATE TABLE RestaurantOwner
(

);

CREATE TABLE Customer
(

);

CREATE TABLE Restaurant
(

);

CREATE TABLE Review
(

);

CREATE TABLE Order 
(

);

CREATE TABLE Dish
(

);