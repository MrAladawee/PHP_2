CREATE DATABASE shop;
CREATE TABLE items (id SERIAL PRIMARY KEY, name VARCHAR(255), image_url VARCHAR(255), price INT, quantity INT);
INSERT INTO items VALUES(1, 'Toyota Mark II', 'tm2.jpg', 25000, 150);
INSERT INTO items VALUES(2, 'Nissan Silvia S15', 'ns15.jpg', 19500, 80);
INSERT INTO items VALUES(3, 'Nissan Silvia S15', 'ns15.jpg', 19500, 80);
INSERT INTO items VALUES(4, 'Nissan GTR', 'ng.jpg', 49500, 50);
INSERT INTO items VALUES(5, 'Posrhe Panamera', 'pp.jpg', 29500, 550);