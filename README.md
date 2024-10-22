## Para rodar projeto

### XAMPP

Realize o download do xampp e startar o servidor e o MySQL.

### Subindo localhost utilizando servidor embutido no PHP

```
php -S localhost:7070 -t public
```

## Banco de Dados

### Schema: test

- Tabela **users**
```sql
CREATE TABLE `test`.`users` (`in_user` INT NOT NULL AUTO_INCREMENT , `name_user` VARCHAR(30) NOT NULL , `email_user` VARCHAR(40) NOT NULL , `password_user` VARCHAR(128) NOT NULL , `title_user` VARCHAR(74) NOT NULL , `code_user` VARCHAR(40) NOT NULL , PRIMARY KEY (`in_user`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
```
