CREATE DATABASE chattr;

USE chattr;

CREATE TABLE IF NOT EXISTS users (
    id         CHAR(36)     NOT NULL DEFAULT (UUID()),
    name       VARCHAR(50)  NOT NULL,
    email      VARCHAR(150) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255) DEFAULT 'default.png',
    description VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_email (email)
);

CREATE TABLE IF NOT EXISTS posts (
    id         CHAR(36)     NOT NULL DEFAULT (UUID()),
    content    VARCHAR(255) NOT NULL,    
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_tag    CHAR(36)     NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_tag) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS likes (
    user_id    CHAR(36)     NOT NULL,
    post_id    CHAR(36)     NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS followers (
    follower_id    CHAR(36)     NOT NULL,
    followed_id    CHAR(36)     NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (follower_id, followed_id),
    FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (followed_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id         CHAR(36)     NOT NULL DEFAULT (UUID()),
    user_id    CHAR(36)     NOT NULL,
    post_id    CHAR(36)     NOT NULL,
    content    VARCHAR(255) NOT NULL,  
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notifications (
    emisor_id    CHAR(36)     NOT NULL,
    receptor_id  CHAR(36)     NOT NULL,
    type         CHAR(10)     NOT NULL,
    link         VARCHAR(255) NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (emisor_id, receptor_id, type, link),
    FOREIGN KEY (emisor_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receptor_id) REFERENCES users(id) ON DELETE CASCADE
);