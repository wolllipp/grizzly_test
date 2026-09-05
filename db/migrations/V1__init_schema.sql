CREATE TABLE applications (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    birth_date DATE NOT NULL,
    email VARCHAR(255),
    marital_status VARCHAR(50) NOT NULL,
    about VARCHAR(1000),
    rules_accepted BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE TABLE phones (
    id SERIAL PRIMARY KEY,
    application_id INTEGER NOT NULL REFERENCES applications(id) ON DELETE CASCADE,
    country_code VARCHAR(5) NOT NULL,
    phone VARCHAR(30) NOT NULL
);

CREATE INDEX idx_phones_application_id ON phones(application_id);
