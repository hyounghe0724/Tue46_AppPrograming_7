use test;

drop table todo_list;

CREATE TABLE `user` (
  `studentNumber` INT PRIMARY KEY NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--';

-- CREATE TABLE `memo` (
--   `studentNumber` INT,
--   `memo` VARCHAR(100) NOT NULL,
--   `date` DATE NOT NULL,
--   PRIMARY KEY (`studentNumber`),[]
    ---------------=
--   CONSTRAINT `fk_memo_studentNumber` FOREIGN KEY (`studentNumber`) REFERENCES `user`(`studentNumber`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



3