CREATE TABLE bucket (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name varchar(100)
);

CREATE TABLE [transaction] (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    description varchar(200),
    date DATE DEFAULT CURRENT_DATE,
    amount INTEGER,
    bucket_id INTEGER,
    FOREIGN KEY (bucket_id) REFERENCES bucket(id)
);