DROP TABLE IF EXISTS books;
CREATE TABLE books (
  id int NOT NULL,
  book_name varchar(100) NOT NULL,
  book_isbn varchar(100) NOT NULL,
  book_category varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO books (id, book_name, book_isbn, book_category) VALUES
(1, 'PHP', 'bk001', 'Server Side'),
(2, 'javascript', 'bk002', 'Client Side'),
(3, 'Python', 'bk003', 'Data Analysis');

ALTER TABLE books
  ADD PRIMARY KEY (id);

ALTER TABLE books
  MODIFY id int NOT NULL AUTO_INCREMENT;