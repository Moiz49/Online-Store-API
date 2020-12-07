create Database if not exists storedatabase;

create table if not exists storedatabase.CUSTOMER(
Customer_Id int NOT NULL PRIMARY KEY,
Name_ varchar(255) NOT NULL,
Email_address varchar(255),
Address varchar(255) NOT NULL);

create table if not exists storedatabase.SHOPPING_CART(
Customer_Id int NOT NULL PRIMARY KEY,
Total_cost int,
FOREIGN KEY (Customer_Id) REFERENCES CUSTOMER(Customer_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.ART_ITEM(
Art_Id int NOT NULL PRIMARY KEY,
Art_name varchar(255) NOT NULL,
Quantity int,
Price int,
Type_ int);

create table if not exists storedatabase.SHOPPING_CART_CONTAINS(
Customer_Id int NOT NULL,
Art_Id int NOT NULL,
PRIMARY KEY (Customer_Id, Art_Id),
FOREIGN KEY (Customer_Id) REFERENCES CUSTOMER(Customer_Id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (Art_Id) REFERENCES ART_ITEM(Art_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.ORDERS(
Order_Id int NOT NULL PRIMARY KEY,
Customer_id int NOT NULL,
Final_cost int,
FOREIGN KEY (Customer_Id) REFERENCES CUSTOMER(Customer_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.SHIPMENT(
Order_Id int NOT NULL PRIMARY KEY,
Status_ varchar(255),
Scompany varchar(255),
Ship_date varchar(255),
Destination varchar(255),
FOREIGN KEY (Order_Id) REFERENCES ORDERS(Order_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.ORDER_CONATAINS(
Order_id int NOT NULL,
Art_Id int NOT NULL,
PRIMARY KEY (Order_Id, Art_Id),
FOREIGN KEY (Art_Id) REFERENCES ART_ITEM(Art_Id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (Order_Id) REFERENCES ORDERS(Order_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.REVIEW(
Customer_Id int NOT NULL,
Art_Id int NOT NULL,
PRIMARY KEY (Customer_Id, Art_Id),
Cname varchar(255),
Review varchar(255),
Date_ varchar(255),
Rating int,
FOREIGN KEY (Art_Id) REFERENCES ART_ITEM(Art_Id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (Customer_Id) REFERENCES CUSTOMER(Customer_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.MATERIAL(
Mat_Id int NOT NULL PRIMARY KEY,
Mat_name varchar(255));

create table if not exists storedatabase.ART_ITEM_MADE_FROM(
Art_Id int NOT NULL,
Mat_Id int NOT NULL,
PRIMARY KEY (Mat_Id, Art_Id),
M_qty_each_item int,
FOREIGN KEY (Art_Id) REFERENCES ART_ITEM(Art_Id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (Mat_Id) REFERENCES MATERIAL(Mat_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.ADMINS(
Username varchar(255) NOT NULL PRIMARY KEY,
Password varchar(255) NOT NULL);

create table if not exists storedatabase.SUPPLY_ORDER(
SO_Id int NOT NULL PRIMARY KEY,
Supplier_name varchar(255) NOT NULL);

create table if not exists storedatabase.MANAGE_INVENTORY(
Username varchar(255) NOT NULL,
Mat_Id int NOT NULL,
PRIMARY KEY (Username, Mat_Id),
M_qty int,
FOREIGN KEY (Mat_Id) REFERENCES MATERIAL(Mat_Id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (Username) REFERENCES ADMINS(Username)
ON DELETE CASCADE
ON UPDATE CASCADE);

create table if not exists storedatabase.ADMIN_MATERIAL_ORDER(
Username varchar(255) NOT NULL,
Mat_Id int NOT NULL,
SO_Id int NOT NULL,
PRIMARY KEY (Username, Mat_Id, SO_Id),
FOREIGN KEY (Username) REFERENCES ADMINS(Username)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (Mat_Id) REFERENCES MATERIAL(Mat_Id)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (SO_Id) REFERENCES SUPPLY_ORDER(SO_Id)
ON DELETE CASCADE
ON UPDATE CASCADE);
