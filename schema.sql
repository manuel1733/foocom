SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `foocom` DEFAULT CHARACTER SET latin1 ;
USE `foocom` ;

-- -----------------------------------------------------
-- Table `foocom`.`allergens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`allergens` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`batches`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`batches` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `purchase_order_id` INT(11) NOT NULL ,
  `product_id` INT(11) NOT NULL ,
  `best_before` DATE NOT NULL ,
  `order_amount` INT(11) NOT NULL ,
  `stock_amount` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`countries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`countries` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`customer_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`customer_groups` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `discount` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`customers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`customers` (
  `user_id` INT(11) NOT NULL ,
  `addition` VARCHAR(255) NOT NULL ,
  `street` VARCHAR(255) NOT NULL ,
  `zipcode` VARCHAR(5) NOT NULL ,
  `city` VARCHAR(255) NOT NULL ,
  `country` VARCHAR(255) NOT NULL ,
  `tel` VARCHAR(255) NOT NULL ,
  `fax` VARCHAR(255) NOT NULL ,
  `mail` VARCHAR(255) NOT NULL ,
  `comment` TEXT NOT NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`employees`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`employees` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `mail` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`labels`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`labels` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`producers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`producers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`product_allergens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`product_allergens` (
  `product_id` INT(11) NOT NULL ,
  `allergen_id` INT(11) NOT NULL ,
  PRIMARY KEY (`product_id`, `allergen_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`product_customer_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`product_customer_groups` (
  `product_id` INT(11) NOT NULL ,
  `customer_group_id` INT(11) NOT NULL ,
  `price` DECIMAL(10,0) NOT NULL ,
  `display` TINYINT(4) NOT NULL ,
  PRIMARY KEY (`product_id`, `customer_group_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`product_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`product_groups` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `parent_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`product_labels`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`product_labels` (
  `product_id` INT(11) NOT NULL ,
  `label_id` INT(11) NOT NULL ,
  PRIMARY KEY (`product_id`, `label_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`product_product_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`product_product_groups` (
  `product_id` INT(11) NOT NULL ,
  `product_group_id` INT(11) NOT NULL ,
  PRIMARY KEY (`product_id`, `product_group_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`product_suppliers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`product_suppliers` (
  `product_id` INT(11) NOT NULL ,
  `supplier_id` INT(11) NOT NULL ,
  `product_number` VARCHAR(255) NOT NULL ,
  `purchase_price` DECIMAL(10,0) NOT NULL ,
  `order_quantity` INT(11) NOT NULL ,
  PRIMARY KEY (`product_id`, `supplier_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`products`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ean` VARCHAR(255) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `min_stock` INT(11) NOT NULL ,
  `order_quantity` INT(11) NOT NULL ,
  `food_value` VARCHAR(255) NOT NULL ,
  `ingredients` VARCHAR(255) NOT NULL ,
  `producer_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`storage_yard_batches`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`storage_yard_batches` (
  `storage_yard_id` INT(11) NOT NULL ,
  `batch_id` INT(11) NOT NULL ,
  PRIMARY KEY (`storage_yard_id`, `batch_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`storage_yards`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`storage_yards` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `store_id` INT(11) NOT NULL ,
  `number` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `number` (`number` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`stores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`stores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`supplier_order_products`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`supplier_order_products` (
  `order_id` INT(11) NOT NULL ,
  `product_id` INT(11) NOT NULL ,
  `order_quantity` INT(11) NOT NULL ,
  `purchase_price` INT(11) NOT NULL ,
  PRIMARY KEY (`order_id`, `product_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`supplier_orders`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`supplier_orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `supplier_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `foocom`.`suppliers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `foocom`.`suppliers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `addition` VARCHAR(255) NOT NULL ,
  `street` VARCHAR(255) NOT NULL ,
  `zipcode` VARCHAR(5) NOT NULL ,
  `city` VARCHAR(255) NOT NULL ,
  `country` VARCHAR(255) NOT NULL ,
  `tel` VARCHAR(255) NOT NULL ,
  `fax` VARCHAR(255) NOT NULL ,
  `mail` VARCHAR(255) NOT NULL ,
  `comment` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
