CREATE DATABASE "my-crud-app"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'English_United States.1252'
    LC_CTYPE = 'English_United States.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

GRANT TEMPORARY, CONNECT ON DATABASE "my-crud-app" TO PUBLIC;

GRANT ALL ON DATABASE "my-crud-app" TO postgres;

CREATE TABLE items (
     itemID            serial NOT NULL PRIMARY KEY,
     name         varchar(80) NOT NULL,   
     sort         int NOT NULL  
);