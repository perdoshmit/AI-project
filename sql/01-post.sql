create table IF NOT EXISTS lesson
(
    id      integer not null
        constraint post_pk
            primary key autoincrement,
    title text not null,
    content text not null
);

INSERT INTO lesson (title, content) VALUES
('Lesson 1', 'Content for Lesson 1'),
('Lesson 2', 'Content for Lesson 2'),
('Lesson 3', 'Content for Lesson 3'),
('fdsfddsf', 'dsggggggggggggggf   fddss  dg');
