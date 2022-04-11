/*****************
  Database Script
******************/

/******** SQLITE OUTPUT CONFIGURATION ********/

PRAGMA foreign_keys = on;

.mode column
.headers ON
.nullvalue NULL



/******** CLEAR TABLES ********/

DROP TABLE IF EXISTS User;

DROP TABLE IF EXISTS CreditCard;
DROP TABLE IF EXISTS BankAccount;

DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Response;

DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS FavoriteDish;
DROP TABLE IF EXISTS FavoriteRestaurant;

DROP TABLE IF EXISTS OrderDish;
DROP TABLE IF EXISTS DishQuantity;



/******** CREATING TABLES ********/

CREATE TABLE User
(
  id INTEGER PRIMARY KEY,
  username VARCHAR UNIQUE CONSTRAINT UserLength CHECK(LENGTH(username) >= 4 AND LENGTH(username) <= 32),
  pw VARCHAR UNIQUE CONSTRAINT PwLength CHECK(LENGTH(pw) >= 6 AND LENGTH(pw) <= 32),
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
  ba_owner VARCHAR NOT NULL CONSTRAINT NameLength CHECK (LENGTH(ba_owner) >= 6 AND LENGTH(ba_owner) <= 96),
  iban VARCHAR NOT NULL UNIQUE CONSTRAINT IBANLength CHECK (LENGTH(iban) = 25)
);

CREATE TABLE Review
(
  id INTEGER PRIMARY KEY,
  author INTEGER REFERENCES User(id),
  restaurant INTEGER REFERENCES Restaurant(id),
  score INTEGER NOT NULL CONSTRAINT ScoreLimit CHECK(score >= 1 AND score <= 5),
  txt VARCHAR NOT NULL CONSTRAINT TextLength CHECK(LENGTH(txt) >= 1 AND LENGTH(txt) <= 256)
);

CREATE TABLE Response
(
  id INTEGER PRIMARY KEY,
  review INTEGER REFERENCES Review(id),
  author INTEGER REFERENCES User(id),
  txt VARCHAR NOT NULL CONSTRAINT TextLength CHECK(LENGTH(txt) >= 1 AND LENGTH(txt) <= 256)
);

CREATE TABLE Restaurant
(
  id INTEGER PRIMARY KEY,
  owner_id REFERENCES User(id),
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

CREATE TABLE OrderDish
(
  id INTEGER PRIMARY KEY,
  customer INTEGER REFERENCES User(id),
  curr_state VARCHAR NOT NULL
);

CREATE TABLE DishQuantity
(
  id INTEGER PRIMARY KEY,
  order_dish INTEGER REFERENCES OrderDish(id),
  dish INTEGER REFERENCES Dish(id),
  quantity INTEGER CONSTRAINT QuantityLimit CHECK(quantity >= 1 AND quantity < 1000)
);



/******** POPULATE DATABASE ********/

/* inserting a customer */

INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_customer", "super_secure_pw", "super_real_address", "987654321");

/* inserting restaurant owners */

INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_owner1", "not_so_secure_pw1", "not_so_real_address1", "999999999");
INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_owner2", "not_so_secure_pw2", "not_so_real_address2", "999999998");
INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_owner3", "not_so_secure_pw3", "not_so_real_address3", "999999997");


/* inserting credit cards */

INSERT INTO CreditCard(owner_id, cc_owner, cc_num, cvv, exp_date) VALUES(1, "John Doe", "9872341782345672", "123", "2022-08-07");


/* inserting bank accounts */

INSERT INTO BankAccount(owner_id, ba_owner, iban) VALUES(2, "Jane Pinkman", "8492837451234128543875899");
INSERT INTO BankAccount(owner_id, ba_owner, iban) VALUES(3, "Ada Lovelace", "8492837451234128543875898");
INSERT INTO BankAccount(owner_id, ba_owner, iban) VALUES(4, "Marie Curie", "8492837451234128543875897");


/* inserting restaurants */

INSERT INTO Restaurant(owner_id, score, res_name, addr, category, coords) VALUES(2, 4.5, "Super Real Restaurant 1", "Random Street 1", "Mexican", "142.13214 -8.421421");
INSERT INTO Restaurant(owner_id, score, res_name, addr, category, coords) VALUES(3, 4.1, "Super Real Restaurant 2", "Random Street 2", "Portuguese", "142.13124 -8.412451");
INSERT INTO Restaurant(owner_id, score, res_name, addr, category, coords) VALUES(4, 4.8, "Super Real Restaurant 3", "Random Street 3", "Spanish", "145.3124 -8.61232");


/* inserting reviews */

INSERT INTO Review(author, restaurant, score, txt) VALUES(1, 2, 4.5, "Very good food.");
INSERT INTO Review(author, restaurant, score, txt) VALUES(1, 3, 4.1, "Not so good food.");
INSERT INTO Review(author, restaurant, score, txt) VALUES(1, 4, 4.8, "Very delicious food.");


/* inserting responses */

INSERT INTO Response(review, author, txt) VALUES(1, 2, "Thank you.");
INSERT INTO Response(review, author, txt) VALUES(2, 3, "We will try to improve.");
INSERT INTO Response(review, author, txt) VALUES(3, 4, "Thank you so much for your feedback.");


/* inserting dishes */

INSERT INTO Dish(price, dish_name, category) VALUES(5.60, "Dish 1", "Mexican");
INSERT INTO Dish(price, dish_name, category) VALUES(4.30, "Dish 2", "Portuguese");
INSERT INTO Dish(price, dish_name, category) VALUES(7.50, "Dish 3", "Spanish");


/* inserting favorite dishes */

INSERT INTO FavoriteDish(user, dish) VALUES(1, 3);


/* inserting favorite restaurants */

INSERT INTO FavoriteRestaurant(user, restaurant) VALUES(1, 3);


/* inserting orders */

INSERT INTO OrderDish(customer, curr_state) VALUES(1, "delivered");


/* inserting orderdish */

INSERT INTO DishQuantity(order_dish, dish, quantity) values(1, 3, 1);
