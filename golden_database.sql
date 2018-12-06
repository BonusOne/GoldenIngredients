-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Lis 2018, 23:19
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.1


--
-- Baza danych: `golden`
--
CREATE DATABASE IF NOT EXISTS `golden` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `golden`;

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addIngredient` (IN `nameIngredient` VARCHAR(255))  BEGIN
    
	DECLARE info VARCHAR(50);
    
	IF (nameIngredient IN (SELECT name FROM ingredient)) THEN
		SET info = 'Ingredient exist';
	ELSE
		INSERT INTO ingredient (name)
		VALUES (nameIngredient);
        SET info = 'Ingredient added';
	END IF;
    
    SELECT info;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addIngredientContains` (IN `IngredientID` INT(10), IN `NutrientID` INT(10), IN `Grams` FLOAT)  BEGIN
    
	DECLARE info VARCHAR(50);
    
	IF (NutrientID IN (SELECT id_nutrients FROM ingredient_contains WHERE id_ingredient = IngredientID)) THEN
		SET info = 'Ingredient contains this nutrient';
	ELSE
		INSERT INTO ingredient_contains (id_ingredient,id_nutrients,grams)
		VALUES (IngredientID,NutrientID,Grams);
        SET info = 'Ingredient with nutrient added';
	END IF;
    
    SELECT info;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addNutrient` (IN `nameNutrient` VARCHAR(255))  BEGIN
    
	DECLARE info VARCHAR(50);
    
	IF (nameNutrient IN (SELECT name FROM nutrients)) THEN
		SET info = 'Nutrient exist';
	ELSE
		INSERT INTO nutrients (name)
		VALUES (nameNutrient);
        SET info = 'Nutrient added';
	END IF;
    
    SELECT info;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addProduct` (IN `ProductName` VARCHAR(255))  BEGIN
    
	DECLARE info VARCHAR(50);
    
	IF (ProductName IN (SELECT name FROM products)) THEN
		SET info = 'Product exist';
	ELSE
		INSERT INTO products (name)
		VALUES (ProductName);
        SET info = 'Product added';
	END IF;
    
    SELECT info;
       
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addProductContains` (IN `ProductID` INT(10), IN `IngredientID` INT(10), IN `Grams` FLOAT)  BEGIN
    
	DECLARE info VARCHAR(50);
    
	IF (IngredientID IN (SELECT id_ingradient FROM product_contains WHERE id_product = ProductID)) THEN
		SET info = 'Product contains this ingredient';
	ELSE
		INSERT INTO product_contains (id_product,id_ingradient,grams)
		VALUES (ProductID,IngredientID,Grams);
        SET info = 'Product with ingredient added';
	END IF;
    
    SELECT info;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addToken` (IN `toku` VARCHAR(255), IN `idu` INT(10))  BEGIN
    DECLARE datetokend DATETIME;
    
    SET datetokend = (SELECT DATE_ADD(NOW(), INTERVAL 30 MINUTE));
    
	INSERT INTO session(token,user_id,datestart,dateend)
		VALUES (toku,idu,NOW(),datetokend);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMaddUser` (IN `emailu` VARCHAR(255), IN `firstnameu` VARCHAR(255), IN `lastnameu` VARCHAR(255), IN `passu` VARCHAR(400), IN `typeu` INT)  BEGIN
	DECLARE info VARCHAR(50);
    
	IF (emailu IN (SELECT email FROM users)) THEN
		SET info = 'Email exist';
	ELSE
		INSERT INTO users (email,firstname,lastname,datetime,type,password)
		VALUES (emailu,firstnameu,lastnameu,NOW(),typeu,passu);
        SET info = 'Registred';
	END IF;
    
    SELECT info;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMchangePass` (IN `idu` INT(10), IN `passwordu` VARCHAR(400))  BEGIN
	DECLARE info VARCHAR(50);

	UPDATE users u
	SET u.password=passwordu
	WHERE u.id=idu;
	
    SET info = 'Changed';
	SELECT info;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMeditUser` (IN `idu` INT(10), IN `firstnameu` VARCHAR(255), IN `lastnameu` VARCHAR(255), IN `typeu` INT(1))  BEGIN
	UPDATE users u
	SET u.firstname=firstnameu, u.lastname=lastnameu, u.type=typeu
	WHERE u.id=idu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMgetIngredient` (IN `idingredient` INT(10))  BEGIN
    
    DECLARE info VARCHAR(255);
    
    IF(idingredient IN (SELECT id_ingredient FROM ingredient)) THEN
		SELECT * FROM ingredient WHERE id_ingredient = idingredient;
    END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMgetNutrients` (IN `idnutrient` INT(10))  BEGIN
    
    DECLARE info VARCHAR(255);
    
    IF(idnutrient IN (SELECT id_nutrients FROM nutrients)) THEN
		SELECT * FROM nutrients WHERE id_nutrients = idnutrient;
    ELSE 
		SET info = '0';
        SELECT info;
    END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMgetProduct` (IN `idProduct` INT(10))  BEGIN
    
    DECLARE info VARCHAR(255);
    
    IF(idProduct IN (SELECT id_products FROM products)) THEN
		SELECT * FROM products WHERE id_products = idProduct;
    ELSE 
		SET info = '0';
        SELECT info;
    END IF;
       
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMgetUser` (IN `idu` INT(10))  BEGIN
		SELECT u.id, u.email, u.firstname, u.lastname, u.datetime, u.type
        FROM users u
        WHERE u.id=idu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADMselectAllUser` ()  BEGIN
		SELECT u.id, u.email, u.firstname, u.lastname, u.datetime, u.type
        FROM users u;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkToken` (IN `toku` VARCHAR(255), IN `idu` INT(10))  BEGIN
	DECLARE info VARCHAR(50);
    DECLARE status VARCHAR(50);
    DECLARE datenow DATETIME;
    DECLARE datetokstart DATETIME;
    DECLARE datetokend DATETIME;
    
    SET datenow = NOW();
    
	IF (idu IN (SELECT user_id FROM session)) THEN
		IF (toku IN (SELECT token FROM session WHERE user_id = idu)) THEN
            SET datetokstart = (SELECT datestart FROM session WHERE user_id = idu and token = toku);
            SET datetokend = (SELECT dateend FROM session WHERE user_id = idu and token = toku);
            IF (datenow BETWEEN datetokstart AND datetokend) THEN
            	SET info = 'Token correct';
                SET status = '1';
                SELECT info,status;
            ELSE
            	SET info = 'Token expired';
                SET status = '0';
                SELECT info,status;
            END IF;
        ELSE
        	SET info = 'Token not exist';
            SET status = '0';
            SELECT info,status;
        END IF;
	ELSE
		SET info = 'Token not exist';
        SET status = '0';
        SELECT info,status;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkUser` (IN `loginu` VARCHAR(255))  BEGIN
	
    DECLARE info VARCHAR(50);
    
	IF (loginu IN (SELECT email FROM users) ) THEN
    	SELECT u.password
        FROM users u
        WHERE u.email=loginu;
		
	ELSE
		SET info = 'Email not exist';
        SELECT info;

	END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editIngredient` (IN `idingradient` INT(10), IN `nameIngradient` VARCHAR(255))  BEGIN
    
	DECLARE info VARCHAR(50);
    
	IF (nameIngradient IN (SELECT name FROM ingredient)) THEN
		SET info = 'Ingradient exist';
	ELSE
		
        UPDATE ingredient
            SET name=nameIngradient
            WHERE id_ingredient=idingradient;
            
        SET info = 'Edited';
	END IF;
    
    SELECT info;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editNutrients` (IN `idnutrients` INT(10), IN `nameNutrients` VARCHAR(255))  BEGIN
    
    DECLARE info VARCHAR(50);
    
	IF (nameNutrients IN (SELECT name FROM nutrients)) THEN
		SET info = 'Nutrient exist';
	ELSE
		
        UPDATE nutrients
            SET name=nameNutrients
            WHERE id_nutrients=idnutrients;
            
        SET info = 'Edited';
	END IF;
    
    SELECT info;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editProduct` (IN `idProduct` INT(10), IN `nameProduct` VARCHAR(255))  BEGIN

    DECLARE info VARCHAR(50);
    
	IF (nameProduct IN (SELECT name FROM products)) THEN
		SET info = 'Nutrient exist';
	ELSE
		
        UPDATE products
            SET name=nameProduct
            WHERE id_products=idProduct;
            
        SET info = 'Edited';
	END IF;
    
    SELECT info;
       
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllIngredient` ()  BEGIN
    
	SELECT * FROM ingredient;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllNutrients` ()  BEGIN
    
	SELECT * FROM nutrients;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllProducts` ()  BEGIN
    
    SELECT * FROM products;
       
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginUser` (IN `login` VARCHAR(255), IN `ipu` VARCHAR(255), IN `agentu` VARCHAR(400))  BEGIN
	
    DECLARE info VARCHAR(50);
    DECLARE idu int(255);

    
	IF (login IN (SELECT email FROM users)) THEN
		SELECT u.id, u.email, u.firstname, u.lastname, u.type
        FROM users u
        WHERE u.email=login;
        
        SELECT u.id
        INTO idu
        FROM users u
        WHERE u.email=login;
        
        INSERT INTO loglogin(id_users,datetime,ip,agent)
			VALUES (idu,NOW(),ipu,agentu);

	ELSE 
		SET info = 'Login or password error';
        SELECT info;
	END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllIngredientsContainsNutrients` ()  BEGIN
    
	SELECT alls.id_ingredient, alls.ingredient, GROUP_CONCAT(alls.grams_in_100 SEPARATOR ', ') as nutrients_in100grams
		FROM (
		SELECT i.name ingredient,i.id_ingredient, CONCAT_WS(':', n.name, ic.grams) grams_in_100
		FROM ingredient_contains as ic
		JOIN ingredient as i ON i.id_ingredient = ic.id_ingredient
		JOIN nutrients as n ON n.id_nutrients = ic.id_nutrients) as alls
	GROUP BY alls.id_ingredient;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllProductsContainsCountIngredientsNutrients` ()  BEGIN
    
	SELECT alls.id_products, alls.product, alls.ingredient, alls.ingr_grams, GROUP_CONCAT(nut_grams SEPARATOR ', ') nutrients
	FROM (SELECT p.id_products, p.name product, i.id_ingredient, i.name ingredient, pc.grams ingr_grams, CONCAT_WS(':', n.name, ic.grams) as nut_grams
		FROM product_contains as pc
		JOIN products as p ON p.id_products = pc.id_product
		JOIN ingredient as i ON i.id_ingredient = pc.id_ingradient
		JOIN (SELECT icin.id_ingredient, icin.id_nutrients, ROUND((icin.grams*((SELECT grams 
																			FROM product_contains 
																			WHERE id_ingradient = icin.id_ingredient)/100)),2) grams
				FROM ingredient_contains as icin) as ic ON ic.id_ingredient = i.id_ingredient
		JOIN nutrients as n ON n.id_nutrients = ic.id_nutrients) as alls
	GROUP BY alls.id_ingredient;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllProductsContainsIngredients` ()  BEGIN
    
	SELECT proding.id_product, proding.product, GROUP_CONCAT(proding.ingradient_grams SEPARATOR ', ') as ingradient_grams
		FROM (SELECT p.name product, pc.id_product, pc.id_ingradient, CONCAT_WS(':', i.name,pc.grams) ingradient_grams
			FROM product_contains as pc
			JOIN products p ON p.id_products = pc.id_product
			JOIN ingredient i ON i.id_ingredient = pc.id_ingradient) as proding
	GROUP BY proding.id_product;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectCount` ()  BEGIN
    
    DECLARE product INT(10);
    DECLARE ingredients INT(10);
    DECLARE nutrients INT(10);
    
    SET product = (SELECT COUNT(*) products FROM products);
    SET ingredients = (SELECT COUNT(*) ingredients FROM ingredient);
    SET nutrients = (SELECT COUNT(*) nutrients FROM nutrients);
    
    SELECT product,ingredients,nutrients;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectIngredientContainsNutrients` (IN `idingredient` INT(10))  BEGIN
    
	SELECT alls.id_ingredient, alls.ingredient, GROUP_CONCAT(alls.grams_in_100 SEPARATOR ', ') as nutrients_in100grams
		FROM (
		SELECT i.name ingredient,i.id_ingredient, CONCAT_WS(':', n.name, ic.grams) grams_in_100
		FROM ingredient_contains as ic
		JOIN ingredient as i ON i.id_ingredient = ic.id_ingredient
		JOIN nutrients as n ON n.id_nutrients = ic.id_nutrients
		WHERE i.id_ingredient = idingredient) as alls
	GROUP BY alls.id_ingredient;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectProductContains` ()  BEGIN
    SELECT p.name, i.name, pc.grams
	FROM product_contains as pc
	JOIN products as p ON p.id_products = pc.id_product
	JOIN ingredient as i ON i.id_ingredient = pc.id_ingradient;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectProductContainsCountIngredient` ()  BEGIN
    SELECT p.name product, i.name ingredient, pc.grams ingr_grams, n.name nutrients, ic.grams nut_grams
	FROM product_contains as pc
	JOIN products as p ON p.id_products = pc.id_product
	JOIN ingredient as i ON i.id_ingredient = pc.id_ingradient
    JOIN (SELECT icin.id_ingredient, icin.id_nutrients, ROUND((icin.grams*((SELECT grams 
																		FROM product_contains 
                                                                        WHERE id_ingradient = icin.id_ingredient)/100)),2) grams
			FROM ingredient_contains as icin) as ic ON ic.id_ingredient = i.id_ingredient
    JOIN nutrients as n ON n.id_nutrients = ic.id_nutrients;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectProductContainsCountIngredientsNutrients` (IN `idproduct` INT(10))  BEGIN
    
	SELECT alls.product, alls.ingredient, alls.ingr_grams, GROUP_CONCAT(nut_grams SEPARATOR ', ') nutrients
	FROM (SELECT p.name product, i.id_ingredient, i.name ingredient, pc.grams ingr_grams, CONCAT_WS(':', n.name, ic.grams) as nut_grams
		FROM product_contains as pc
		JOIN products as p ON p.id_products = pc.id_product
		JOIN ingredient as i ON i.id_ingredient = pc.id_ingradient
		JOIN (SELECT icin.id_ingredient, icin.id_nutrients, ROUND((icin.grams*((SELECT grams 
																			FROM product_contains 
																			WHERE id_ingradient = icin.id_ingredient and id_product = idproduct)/100)),2) grams
				FROM ingredient_contains as icin) as ic ON ic.id_ingredient = i.id_ingredient
		JOIN nutrients as n ON n.id_nutrients = ic.id_nutrients
		WHERE p.id_products = idproduct) as alls
	GROUP BY alls.id_ingredient;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectProductContainsIngredients` (IN `idproduct` INT(10))  BEGIN
    
	SELECT proding.id_product, proding.product, GROUP_CONCAT(proding.ingradient_grams SEPARATOR ', ') as ingradient_grams
		FROM (SELECT p.name product, pc.id_product, pc.id_ingradient, CONCAT_WS(':', i.name,pc.grams) ingradient_grams
			FROM product_contains as pc
			JOIN products p ON p.id_products = pc.id_product
			JOIN ingredient i ON i.id_ingredient = pc.id_ingradient
			WHERE pc.id_product = `idproduct` ) as proding
	
GROUP BY proding.id_product;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient`
--

CREATE TABLE `ingredient` (
  `id_ingredient` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient`
--

INSERT INTO `ingredient` (`id_ingredient`, `name`) VALUES
(1, 'White flour'),
(2, 'Salt'),
(3, 'Sachet yeast'),
(4, 'Olive oil'),
(5, 'Water'),
(6, 'Salami');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient_contains`
--

CREATE TABLE `ingredient_contains` (
  `id_ic` int(10) UNSIGNED NOT NULL,
  `id_ingredient` int(10) UNSIGNED NOT NULL,
  `id_nutrients` int(10) UNSIGNED NOT NULL,
  `grams` float NOT NULL COMMENT 'in 100grams'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient_contains`
--

INSERT INTO `ingredient_contains` (`id_ic`, `id_ingredient`, `id_nutrients`, `grams`) VALUES
(1, 1, 1, 350),
(2, 1, 3, 10),
(3, 1, 4, 75),
(4, 1, 5, 1.5),
(5, 1, 6, 0.5),
(6, 1, 7, 75),
(7, 3, 1, 325),
(8, 3, 3, 40.5),
(9, 3, 5, 7.5),
(10, 3, 7, 41),
(11, 2, 6, 40000),
(12, 4, 5, 100),
(13, 4, 1, 850),
(14, 4, 6, 0.2),
(15, 5, 6, 0.5),
(16, 6, 1, 406),
(17, 6, 3, 20),
(18, 6, 4, 1.8),
(19, 6, 5, 36);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loglogin`
--

CREATE TABLE `loglogin` (
  `id_log` bigint(50) UNSIGNED NOT NULL,
  `id_users` int(20) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `loglogin`
--

INSERT INTO `loglogin` (`id_log`, `id_users`, `datetime`, `ip`, `agent`) VALUES
(1, 1, '2018-11-15 21:42:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(2, 1, '2018-11-15 23:41:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(3, 1, '2018-11-16 18:13:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(4, 1, '2018-11-16 19:19:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(5, 1, '2018-11-16 19:55:56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(6, 1, '2018-11-16 20:28:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(7, 1, '2018-11-16 21:06:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(8, 1, '2018-11-16 21:28:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(9, 1, '2018-11-16 23:02:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(10, 1, '2018-11-16 23:04:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(11, 2, '2018-11-16 23:04:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(12, 2, '2018-11-16 23:05:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36'),
(13, 1, '2018-11-16 23:05:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nutrients`
--

CREATE TABLE `nutrients` (
  `id_nutrients` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nutrients`
--

INSERT INTO `nutrients` (`id_nutrients`, `name`) VALUES
(1, 'Kcal'),
(3, 'Proteins'),
(4, 'Carbohydrates'),
(5, 'Fat'),
(6, 'Sodium'),
(7, 'Carbs');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id_products` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id_products`, `name`) VALUES
(1, 'Bread'),
(2, 'Pizza');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_contains`
--

CREATE TABLE `product_contains` (
  `id_pc` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `id_ingradient` int(10) UNSIGNED NOT NULL,
  `grams` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product_contains`
--

INSERT INTO `product_contains` (`id_pc`, `id_product`, `id_ingradient`, `grams`) VALUES
(1, 1, 1, 650),
(2, 1, 2, 5),
(3, 1, 3, 10),
(4, 1, 4, 10),
(5, 1, 5, 400),
(7, 2, 1, 500),
(8, 2, 3, 3),
(9, 2, 6, 30),
(10, 2, 5, 300),
(11, 2, 4, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `session`
--

CREATE TABLE `session` (
  `id` bigint(50) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `datestart` datetime NOT NULL,
  `dateend` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `session`
--

INSERT INTO `session` (`id`, `token`, `user_id`, `datestart`, `dateend`) VALUES
(1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE1VDIxOjQyOjQ1KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.GdZDSo1EBb9ozwylIpcTvmXv1SGTvOrOPAKjJxa1haA', 1, '2018-11-15 21:42:45', '2018-11-15 22:12:45'),
(2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE1VDIzOjQxOjE2KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.e2mFiknRmOJcDIUmpLTohP30b3lH5vF5XLNRYHUO4-4', 1, '2018-11-15 23:41:16', '2018-11-16 00:11:16'),
(3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDE4OjEzOjM4KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.WvtS78ckXoiJMqe4H5ptYH77rpIZYys91Xd-vgyakIE', 1, '2018-11-16 18:13:38', '2018-11-16 18:43:38'),
(4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDE5OjE5OjMyKzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.j5jf6tHarbm9Hx8yBS6c3415vDIop8s07q-I8_d4Uqs', 1, '2018-11-16 19:19:32', '2018-11-16 19:49:32'),
(5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDE5OjU1OjU2KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.BfNdR9Uy9TqTLDOLtGMq9RIgtHmMwH96j1zlmexkIGM', 1, '2018-11-16 19:55:56', '2018-11-16 20:25:56'),
(6, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIwOjI4OjA3KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.xcaUeRHn7tbT6HzrXE4pNeTibjbyRVAuUQ8t5pZp_7k', 1, '2018-11-16 20:28:07', '2018-11-16 20:58:07'),
(7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIxOjA2OjA3KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.wiySZ97g9q2eclB1K36en7wbGmGXYU-IfRY3WWp-GZE', 1, '2018-11-16 21:06:07', '2018-11-16 21:36:07'),
(8, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIxOjI4OjI1KzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.NXvKV0E_-2tEiur5Sxljxzn3Mo0C4_tU9aGSoFU_YMc', 1, '2018-11-16 21:28:25', '2018-11-16 21:58:25'),
(9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIzOjAyOjAzKzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.mfDzlLrRtiZ8KTy6WK2SrORDVBFl4el6Iv-Knl6xoe8', 1, '2018-11-16 23:02:03', '2018-11-16 23:32:03'),
(10, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIzOjA0OjMyKzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.u2TBRNOhDF7qAbQjE5eRKyxNT_KxBsV_0_FuOH4XJ9I', 1, '2018-11-16 23:04:32', '2018-11-16 23:34:32'),
(11, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIzOjA0OjQ5KzAxMDAifQ.eyJ1c2VyX2lkIjoiMiJ9.UeHY-riJZwVM2XqrBoEBiRl4Nr0z6bMctpEZFJR8lBM', 2, '2018-11-16 23:04:49', '2018-11-16 23:34:49'),
(12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIzOjA1OjA3KzAxMDAifQ.eyJ1c2VyX2lkIjoiMiJ9.6hY2NsdgLKC5K0bMWCwLaKM94ZT_xfFALqDHZ4yYhcw', 2, '2018-11-16 23:05:07', '2018-11-16 23:35:07'),
(13, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImRhdGUiOiIyMDE4LTExLTE2VDIzOjA1OjEwKzAxMDAifQ.eyJ1c2VyX2lkIjoiMSJ9.xRZQ_fWVxIit8usKFLfidkPp9_C47qeRDkqYkuLFjCA', 1, '2018-11-16 23:05:10', '2018-11-16 23:35:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `type` int(1) NOT NULL DEFAULT '2',
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `datetime`, `type`, `password`) VALUES
(1, 'pawel.liwocha@gmail.com', 'Paweł', 'Liwocha', '2018-11-15 17:25:42', 2, '$2y$10$H7yfFECZuU1v6WFIuK52duNMhhMguc6lcPuCmV.bWmhadBWwrynt.'),
(2, 'test@test.com', 'Test', 'Testowy', '2018-11-15 17:59:15', 2, '$2y$10$c6.5KYjFK7DkemdCwDjzZ.qMhtF/YkdL0VU6qKbG0Y752pstwM98e');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Indeksy dla tabeli `ingredient_contains`
--
ALTER TABLE `ingredient_contains`
  ADD PRIMARY KEY (`id_ic`),
  ADD KEY `id_ingredient` (`id_ingredient`,`id_nutrients`),
  ADD KEY `id_nutrients` (`id_nutrients`);

--
-- Indeksy dla tabeli `loglogin`
--
ALTER TABLE `loglogin`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeksy dla tabeli `nutrients`
--
ALTER TABLE `nutrients`
  ADD PRIMARY KEY (`id_nutrients`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_products`);

--
-- Indeksy dla tabeli `product_contains`
--
ALTER TABLE `product_contains`
  ADD PRIMARY KEY (`id_pc`),
  ADD KEY `id_product` (`id_product`,`id_ingradient`),
  ADD KEY `id_ingradient` (`id_ingradient`);

--
-- Indeksy dla tabeli `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ingredient` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `ingredient_contains`
--
ALTER TABLE `ingredient_contains`
  MODIFY `id_ic` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `loglogin`
--
ALTER TABLE `loglogin`
  MODIFY `id_log` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `nutrients`
--
ALTER TABLE `nutrients`
  MODIFY `id_nutrients` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id_products` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `product_contains`
--
ALTER TABLE `product_contains`
  MODIFY `id_pc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `session`
--
ALTER TABLE `session`
  MODIFY `id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ingredient_contains`
--
ALTER TABLE `ingredient_contains`
  ADD CONSTRAINT `ingredient_contains_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredient`),
  ADD CONSTRAINT `ingredient_contains_ibfk_2` FOREIGN KEY (`id_nutrients`) REFERENCES `nutrients` (`id_nutrients`);

--
-- Ograniczenia dla tabeli `loglogin`
--
ALTER TABLE `loglogin`
  ADD CONSTRAINT `loglogin_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `product_contains`
--
ALTER TABLE `product_contains`
  ADD CONSTRAINT `product_contains_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_products`),
  ADD CONSTRAINT `product_contains_ibfk_2` FOREIGN KEY (`id_ingradient`) REFERENCES `ingredient` (`id_ingredient`);

--
-- Ograniczenia dla tabeli `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;


