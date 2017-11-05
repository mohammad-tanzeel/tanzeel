CREATE TABLE users
(
  id integer NOT NULL,
  name text,
  country_id integer,
  email text,
  mobile bigint,
  about text,
  birthday date,
  CONSTRAINT users_pkey PRIMARY KEY (id)
)
