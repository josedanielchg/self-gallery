DROP DATABASE IF EXISTS selfgallery;

CREATE DATABASE IF NOT EXISTS selfgallery;

USE selfgallery;

/*Users table*/
CREATE TABLE users(
     id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     email VARCHAR(255) UNIQUE NOT NULL,
     username VARCHAR(16) UNIQUE NOT NULL,
     password  VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     publications INTEGER UNSIGNED NOT NULL DEFAULT 0,
     profile_image INTEGER UNSIGNED NOT NULL DEFAULT 1
);

/*Images table*/
CREATE TABLE images(
     image_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
     filename VARCHAR(33) NOT NULL ,
     user_id INTEGER UNSIGNED DEFAULT NULL,
     FOREIGN KEY (user_id) REFERENCES users(id)
          ON DELETE RESTRICT ON UPDATE CASCADE
);

/*Default profile image*/
INSERT INTO images (filename) VALUES ('profile.png');