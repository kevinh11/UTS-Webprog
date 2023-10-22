DROP DATABASE restaurant;
CREATE DATABASE restaurant;
USE restaurant;


CREATE TABLE menu(
	food_id VARCHAR(5) NOT NULL, 
    food_name VARCHAR(30), 
    food_desc VARCHAR(200),
    food_category VARCHAR(30), 
    food_price INT, 
    food_imgpath VARCHAR(50),
    PRIMARY KEY (food_id)
);

CREATE TABLE user(
    user_first VARCHAR(30), 
	user_last VARCHAR(30), 
    user_email VARCHAR(30),
	user_pass VARCHAR(100), 
    user_birth DATE,
    user_gender VARCHAR(10),
    CHECK (user_gender IN ('M', 'F')),
    PRIMARY KEY (user_email)
);

CREATE TABLE admin(
	admin_id INT AUTO_INCREMENT NOT NULL, 
    admin_first VARCHAR(30), 
	admin_last VARCHAR(30), 
    admin_email VARCHAR(30),
	admin_pass VARCHAR(100), 
    admin_birth DATE,
    admin_gender VARCHAR(10),
    CHECK (admin_gender IN ('M', 'F')),
    PRIMARY KEY (admin_id)
);

INSERT INTO menu
VALUES
	('F0001', 'Es Teh Tawar', 'Teh disaijkan dengan Es batu yang menyegarkan', 'Minuman', 5000, 'gambarMenu/esTehTawar.jpg'),
	('F0002', 'Teh Botol', 'Teh Manis yang menyegarkan', 'Minuman', 5000, 'gambarMenu/tehBotol.jpg'), 
	('F0003', 'Nasi Ayam Geprek', 'Ayam Goreng Krispi disajikan dengan sambal bawang serta nasi putih', 'Makanan', 20000, 'gambarMenu/nasiAyamGeprek.jpg'),
	('F0004', 'Nasi Goreng Seafood', 'Nasi ditumis dengan rempah-rempah dan campuran seafood', 'Makanan', 25000, 'gambarMenu/nasiGorengSeafood.jpg'),
	('F0005', 'Bakmi Ayam', 'Mie dengan racikan bumbu rahasia dan ayam jamur spesial', 'Makanan', 20000, 'gambarMenu/bakmiAyam.jpg'), 
	('F0006', 'Soto Ayam', 'Soto Ayam adalah hidangan sup tradisional Indonesia yang terbuat dari kaldu ayam yang kaya rasa, disajikan dengan potongan ayam, mie, dan bumbu-bumbu rempah', 'Makanan', 15000, 'gambarMenu/sotoAyam.jpg'),
	('F0007', 'Sate Kambing', 'Sate Kambing adalah hidangan sate yang terbuat dari daging kambing yang dipanggang di atas bara api', 'Makanan', 30000, 'gambarMenu/sateKambing.jpg'),
	('F0008', 'Es Jeruk', 'Es Jeruk adalah minuman segar yang terbuat dari perasan jeruk manis yang dicampur dengan es dan gula', 'Minuman', 6000, 'gambarMenu/esJeruk.jpg'),
	('F0009', 'Nasi Putih', 'Nasi Putih adalah beras yang dimasak hingga matang', 'Makanan', 10000, 'gambarMenu/nasiPutih.jpg'),
	('F0010', 'Kopi', 'Kopi adalah minuman yang terbuat dari biji kopi yang digiling', 'Minuman', 5000, 'gambarMenu/kopi.jpg');


SELECT * FROM MENU;

SELECT * FROM user;