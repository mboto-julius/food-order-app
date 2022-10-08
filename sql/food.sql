CREATE USER 'adminfood'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mysql-Password-2022';

GRANT ALL PRIVILEGES ON foodapp.* TO 'adminfood'@'localhost' WITH GRANT OPTION;

FLUSH PRIVILEGES;

create table users(
   id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   full_name varchar(100) NOT NULL,
   username varchar(100) NOT NULL,
   password varchar(255) NOT NULL
 );

create table categories(
   id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title varchar(100),
   image_name varchar(255),
   featured varchar(10),
   active varchar(10)
);

create table foods(
   id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title varchar(150),
   description text,
   price decimal(10, 2) NOT NULL,
   image_name varchar(255),
   featured int(10) NOT NULL,
   active int(10) NOT NULL,
   category_id int NOT NULL,
   CONSTRAINT FK_category FOREIGN KEY (category_id) REFERENCES categories(id)
);

create table orders(
   id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   food varchar(150),
   price decimal(10,2),
   qty int,
   total decimal(10,2),
   order_date datetime,
   status varchar(50),
   customer_name varchar(150),
   customer_contact varchar(20),
   customer_email varchar(150),
   customer_address varchar(255)
);


