use test;

drop table todo_list;

CREATE TABLE `user` (
  `studentNumber` INT PRIMARY KEY NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE memo (
  studentNumber INT,
  memo VARCHAR(255),
  date DATE,
  FOREIGN KEY (studentNumber) REFERENCES user (studentNumber)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

