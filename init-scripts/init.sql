\c ddss_db;

CREATE TABLE users(
    id SERIAL PRIMARY KEY,
    username VARCHAR(100),
    password TEXT NOT NULL
);

CREATE TABLE content(
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER DATABASE ddss_db OWNER TO ddss_user;

ALTER TABLE users OWNER TO ddss_user;
ALTER SEQUENCE users_id_seq OWNER TO ddss_user;
ALTER TABLE content OWNER TO ddss_user;
ALTER SEQUENCE content_id_seq OWNER TO ddss_user;