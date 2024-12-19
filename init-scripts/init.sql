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

/* create some posts ... */
INSERT INTO content (title, content) VALUES ('My Friend Goo', 'Has a Real Tattoo...\nShe Always Knows Just What To Do...');
INSERT INTO content (title, content) VALUES ('N.I.B', 'Some people say My Love cannot be true...\nPlease believe me, My Love, And ill show you!');
