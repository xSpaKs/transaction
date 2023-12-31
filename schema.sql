CREATE TABLE users (
    id INT(10) PRIMARY KEY,
    username VARCHAR(255),
    mail VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transactions (
    id INT(10) PRIMARY KEY,
    user_id INT(10),
    FOREIGN KEY (user_id) REFERENCES users(id),
    label TEXT,
    amount INT(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);