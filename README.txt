CREATE DATABASES < databases_name.;
show databases;
connect <databases_name>;
CREATE TABLE <table_name_in_plural> (
INSERT INTO <table_name_in_plural>
            (column) Values
            (Values);

);



#Utility Commands
\! cls

mysqldump -u root -p --databases library_dodo > C:\xampp\htdocs\dev\backups1\081826_library_dodo.sql
mysqldump -u root -p --databases library_dodo > "C:\xampp\htdocs\dev\it30b_navarro\backups1\%date:~-4%%date:~3,2%%date:~0,2%_%time:~0,2%%time:~3,2%%time:~6,2%_library_dodo.sql"