For opening the project you need:
1. Create database “book”  in phpMyAdmin;
2. Import file:  book.sql for creating data base that is in archive.
3. In data base “book”, in tab SQL paste query: 
CREATE USER 'lena_diana'@'localhost' IDENTIFIED BY '12346';
 GRANT ALL PRIVILEGES ON * . * TO 'lena_diana'@'localhost';
4. Paste folder  ”book” in:      C:\xampp\htdocs
5. In browser enter: localhost/book/index.php
