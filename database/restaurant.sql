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

DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Response;

DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS FavoriteDish;
DROP TABLE IF EXISTS FavoriteRestaurant;

DROP TABLE IF EXISTS OrderDish;
DROP TABLE IF EXISTS DishQuantity;

DROP TABLE IF EXISTS DishCategory;
DROP TABLE IF EXISTS RestaurantCategory;
DROP TABLE IF EXISTS Category;


/******** CREATING TABLES ********/

CREATE TABLE User
(
  id INTEGER PRIMARY KEY,
  username VARCHAR UNIQUE CONSTRAINT UserLength CHECK(LENGTH(username) >= 4 AND LENGTH(username) <= 32),
  pw VARCHAR UNIQUE CONSTRAINT PwLength CHECK(LENGTH(pw) >= 6 AND LENGTH(pw) <= 32),
  addr VARCHAR NOT NULL CONSTRAINT AddressLength CHECK(LENGTH(addr) >= 8 AND LENGTH(addr) <= 256),
  phone_number VARCHAR CONSTRAINT PhoneNumberLength CHECK(LENGTH(phone_number) = 9) 
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
  coords VARCHAR
);

CREATE TABLE Dish
(
  id INTEGER PRIMARY KEY,
  restaurant INTEGER REFERENCES Restaurant(id),
  price REAL NOT NULL CONSTRAINT PriceLimit CHECK(price >= 0),
  dish_name VARCHAR NOT NULL CONSTRAINT DishNameLength CHECK(LENGTH(dish_name) >= 1 AND LENGTH(dish_name) <= 64)
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

CREATE TABLE Category
(
  id INTEGER PRIMARY KEY,
  category_name VARCHAR NOT NULL CONSTRAINT category_name_length CHECK (LENGTH(category_name) >= 3 AND LENGTH(category_name) < 32)
);

CREATE TABLE DishCategory
(
  dish INTEGER REFERENCES Dish(id),
  category INTEGER REFERENCES Category(id)
);

CREATE TABLE RestaurantCategory
(
  restaurant INTEGER REFERENCES Restaurant(id),
  category INTEGER REFERENCES Category(id)
);

/******** POPULATE DATABASE ********/

/* inserting a customer */

INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_customer", "super_secure_pw", "super_real_address", "987654321");


/* inserting restaurant owners */

INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_owner1", "not_so_secure_pw1", "not_so_real_address1", "999999999");
INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_owner2", "not_so_secure_pw2", "not_so_real_address2", "999999998");
INSERT INTO User(username, pw, addr, phone_number) VALUES("super_real_owner3", "not_so_secure_pw3", "not_so_real_address3", "999999997");


/* inserting restaurants */

INSERT INTO Restaurant(owner_id, score, res_name, addr, coords) VALUES(2, 4.5, "Super Real Restaurant 1", "Random Street 1", "142.13214 -8.421421");
INSERT INTO Restaurant(owner_id, score, res_name, addr, coords) VALUES(3, 4.1, "Super Real Restaurant 2", "Random Street 2", "142.13124 -8.412451");
INSERT INTO Restaurant(owner_id, score, res_name, addr, coords) VALUES(4, 4.8, "Super Real Restaurant 3", "Random Street 3", "145.3124 -8.61232");


/* inserting reviews */

INSERT INTO Review(author, restaurant, score, txt) VALUES(1, 1, 4.5, "Very good food.");
INSERT INTO Review(author, restaurant, score, txt) VALUES(1, 2, 4.1, "Not so good food.");
INSERT INTO Review(author, restaurant, score, txt) VALUES(1, 3, 4.8, "Very delicious food.");


/* inserting responses */

INSERT INTO Response(review, author, txt) VALUES(1, 2, "Thank you.");
INSERT INTO Response(review, author, txt) VALUES(2, 3, "We will try to improve.");
INSERT INTO Response(review, author, txt) VALUES(3, 4, "Thank you so much for your feedback.");


/* inserting dishes */

INSERT INTO Dish(restaurant, price, dish_name) VALUES(1, 5.60, "Dish 1");
INSERT INTO Dish(restaurant, price, dish_name) VALUES(2, 4.30, "Dish 2");
INSERT INTO Dish(restaurant, price, dish_name) VALUES(3, 7.50, "Dish 3");


/* inserting favorite dishes */

INSERT INTO FavoriteDish(user, dish) VALUES(1, 3);


/* inserting favorite restaurants */

INSERT INTO FavoriteRestaurant(user, restaurant) VALUES(1, 3);


/* inserting orders */

INSERT INTO OrderDish(customer, curr_state) VALUES(1, "delivered");
INSERT INTO OrderDish(customer, curr_state) VALUES(1, "delivered");
INSERT INTO OrderDish(customer, curr_state) VALUES(1, "delivered");


/* inserting orderdish */

INSERT INTO DishQuantity(order_dish, dish, quantity) values(1, 1, 1);
INSERT INTO DishQuantity(order_dish, dish, quantity) values(2, 2, 1);
INSERT INTO DishQuantity(order_dish, dish, quantity) values(3, 3, 1);


/* inserting categories */

INSERT INTO Category(category_name) VALUES("Vegan");        /* id = 1 */
INSERT INTO Category(category_name) VALUES("Fast-food");    /* id = 2 */
INSERT INTO Category(category_name) VALUES("Vegetarian");   /* id = 3 */
INSERT INTO Category(category_name) VALUES("Gluten-free");  /* id = 4 */
INSERT INTO Category(category_name) VALUES("Lactose-free"); /* id = 5 */
INSERT INTO Category(category_name) VALUES("Premium");      /* id = 6 */
INSERT INTO Category(category_name) VALUES("Affordable");   /* id = 7 */
INSERT INTO Category(category_name) VALUES("Sushi");        /* id = 8 */
INSERT INTO Category(category_name) VALUES("Diet");         /* id = 9 */


/* inserting dish categories */

INSERT INTO DishCategory(dish, category) VALUES(1, 1);
INSERT INTO DishCategory(dish, category) VALUES(1, 3);
INSERT INTO DishCategory(dish, category) VALUES(1, 6);

INSERT INTO DishCategory(dish, category) VALUES(2, 4);
INSERT INTO DishCategory(dish, category) VALUES(2, 7);
INSERT INTO DishCategory(dish, category) VALUES(2, 2);

INSERT INTO DishCategory(dish, category) VALUES(3, 9);
INSERT INTO DishCategory(dish, category) VALUES(3, 8);


/* inserting restaurant categories */

INSERT INTO RestaurantCategory(restaurant, category) VALUES(1, 2);
INSERT INTO RestaurantCategory(restaurant, category) VALUES(2, 8);
INSERT INTO RestaurantCategory(restaurant, category) VALUES(3, 6);
