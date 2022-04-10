/*****************
  Database Script
******************/


/* USE APPROPRIATE MODES */

PRAGMA foreign_keys = on;

.mode table
.headers ON
.nullvalue NULL


/* CLEAR TABLES */

DROP TABLE IF EXISTS User;

DROP TABLE IF EXISTS CreditCard;
DROP TABLE IF EXISTS BankAccount;

DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Response;

DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS FavoriteDish;
DROP TABLE IF EXISTS FavoriteRestaurant;

DROP TABLE IF EXISTS Order;
DROP TABLE IF EXISTS OrderDish;


/* CREATING TABLES */

CREATE TABLE User
(
  id INTEGER PRIMARY KEY,
  username VARCHAR(32) UNIQUE CONSTRAINT UserLength CHECK(LENGTH(username) >= 4 AND LENGTH(username) <= 32),
  pw VARCHAR(32) UNIQUE CONSTRAINT PwLength CHECK(LENGTH(pw) >= 6 AND LENGTH(pw) <= 32),
  addr VARCHAR NOT NULL CONSTRAINT AddressLength CHECK(LENGTH(addr) >= 8 AND LENGTH(addr) <= 256),
  phone_number VARCHAR CONSTRAINT PhoneNumberLength CHECK(LENGTH(phone_number) = 9) 
);

CREATE TABLE CreditCard
(
  id INTEGER PRIMARY KEY,
  owner_id INTEGER REFERENCES User(id),
  cc_owner VARCHAR NOT NULL CONSTRAINT NameLength CHECK (LENGTH(cc_owner) > 6 AND LENGTH(cc_owner) <= 96),
  cc_num VARCHAR NOT NULL UNIQUE CONSTRAINT LengthCCNum CHECK (LENGTH(cc_num) >= 16 AND LENGTH(cc_num) <= 20),
  cvv VARCHAR(3) NOT NULL CONSTRAINT LengthCVV CHECK (LENGTH(cvv) = 3),
  exp_date DATE NOT NULL
);

CREATE TABLE BankAccount
(
  id INTEGER PRIMARY KEY,
  owner_id INTEGER REFERENCES User(id),
  ba_owner ARCHAR NOT NULL CONSTRAINT NameLength CHECK (LENGTH(ba_owner) >= 6 AND LENGTH(ba_owner) <= 96),
  iban VARCHAR(25) NOT NULL UNIQUE CONSTRAINT IBANLength CHECK (LENGTH(iban) = 25)
);

CREATE TABLE Review
(
  id INTEGER PRIMARY KEY,
  customer INTEGER REFERENCES User(id),
  restaurant INTEGER REFERENCES Restaurant(id),
  score INTEGER NOT NULL CONSTRAINT ScoreLimit CHECK(score >= 1 AND score <= 5),
  txt VARCHAR NOT NULL CONSTRAINT TextLength CHECK(LENGTH(txt) >= 1 AND LENGTH(txt) <= 256)
);

CREATE TABLE Response
(
  id INTEGER PRIMARY KEY,
  review INTEGER REFERENCES Review(id),
  restaurantOwner INTEGER REFERENCES User(id),
  score INTEGER NOT NULL CONSTRAINT ScoreLimit CHECK(score >= 1 AND score <= 5),
  txt VARCHAR NOT NULL CONSTRAINT TextLength CHECK(LENGTH(txt) >= 1 AND LENGTH(txt) <= 256)
);

CREATE TABLE Restaurant
(
  id INTEGER PRIMARY KEY,
  score REAL NOT NULL CONSTRAINT ScoreLimit CHECK(score >= 1 AND score <= 5),
  res_name VARCHAR,
  addr VARCHAR,
  category VARCHAR,
  coords VARCHAR
);

CREATE TABLE Dish
(
  id INTEGER PRIMARY KEY,
  price REAL NOT NULL CONSTRAINT PriceLimit CHECK(price >= 0),
  dish_name VARCHAR NOT NULL CONSTRAINT DishNameLength CHECK(LENGTH(dish_name) >= 1 AND LENGTH(dish_name) <= 64),
  category VARCHAR NOT NULL CONSTRAINT CategoryLength CHECK(LENGTH(category) >= 1 AND LENGTH(category) <= 64)
);

CREATE TABLE FavoriteDish
(
  user INTEGER REFERENCES User(id),
  dish INTEGER REFERENCES Dish(id),
  PRIMARY KEY (user, dish)
);

CREATE TABLE FavoriteRestaurant
(
  user INTEGER REFERENCES User(id),
  restaurant INTEGER REFERENCES Restaurant(id),
  PRIMARY KEY (user, restaurant)
);

CREATE TABLE Order 
(
  id INTEGER PRIMARY KEY,
  customer INTEGER REFERENCES User(id),
  curr_state VARCHAR NOT NULL CONSTRAINT StateLength CHECK(LENGTH(curr_state) >= 5 AND LENGTH(text) <= 9)
);

CREATE TABLE OrderDish
(
  id INTEGER PRIMARY KEY,
  order INTEGER REFERENCES Order(id),
  dish INTEGER REFERENCES Dish(id),
  quantity INTEGER CONSTRAINT QuantityLimit CHECK(quantity > 1 AND quantity < 1000),
);
