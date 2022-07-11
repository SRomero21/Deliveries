CREATE TABLE `users`(
    `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `frist_name_user` TEXT NOT NULL,
    `last_name_user` TEXT NOT NULL,
    `avatar_user` TEXT NOT NULL,
    `email_user` TEXT NOT NULL,
    `nick_user` TEXT NOT NULL,
    `password_user` TEXT NOT NULL,
    `activation_code_user` TINYINT(1) NOT NULL,
    `logged_in_user` TINYINT(1) NOT NULL,
    `token_user` TEXT NOT NULL,
    `token_exp_user` DATE NOT NULL,
    `data_create_user` DATETIME NOT NULL,
    `data_update_user` INT NOT NULL
);
CREATE TABLE `products`(
    `id_product` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name_product` TEXT NOT NULL,
    `description_product` TEXT NOT NULL,
    `cantidad_product` TEXT NOT NULL,
    `precio_product` DOUBLE NOT NULL,
    `data_create_product` DATETIME NOT NULL,
    `data_update_product` DATETIME NOT NULL
);
CREATE TABLE `orders`(
    `id_order` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user_order` INT NOT NULL,
    `id_product_order` INT NOT NULL,
    `order_date_order` DATE NOT NULL,
    `paking_time_order` INT NOT NULL,
    `transportation_time_order` INT NOT NULL,
    `delivery_time_order` INT NOT NULL,
    `data_create_order` DATETIME NOT NULL,
    `data_update_order` INT NOT NULL
);
ALTER TABLE
    `orders` ADD INDEX `orders_id_user_order_id_product_order_index`(
        `id_user_order`,
        `id_product_order`
    );
ALTER TABLE
    `orders` ADD CONSTRAINT `orders_id_user_order_foreign` FOREIGN KEY(`id_user_order`) REFERENCES `users`(`id_user`);
ALTER TABLE
    `orders` ADD CONSTRAINT `orders_id_product_order_foreign` FOREIGN KEY(`id_product_order`) REFERENCES `products`(`id_product`);