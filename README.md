### MySQL Examples Demo for SimFul

## Demo

| End-point    | URL                                                 |
|--------------|-----------------------------------------------------|
| GET /users   | http://u4bi.dothome.co.kr/mysql-demo/app.php/users  |
| GET /user/1  | http://u4bi.dothome.co.kr/mysql-demo/app.php/user/1 |

### GET

| End-point | /users                                                                                                |
|------------|--------------------------------------------------------------------------------------------------------|
| result | [{"id":"1","name":"u4bi","pay":"15000","age":"17"},{"id":"2","name":"rev","pay":"7000","age":"21"}]   |

### GET

| End-point | /user/:id                                                                                           |
|------------|-----------------------------------------------------------------------------------------|
| result | {"id":"1","name":"u4bi","pay":"15000","age":"17"} |

### POST

| End-point | /user                                                                                               |
|------------|-----------------------------------------------------------------------------------------|
| result | { "notice" : { "text" : "added successfully" } |
| body | { "name" : "u4bi", "pay" : 15000, "age" : 17 } |

### PUT

| End-point | /user/:id                                                                                            |
|------------|-----------------------------------------------------------------------------------------|
| result | { "notice" : { "text" : "updated successfully" }   |
| body | { "name" : "u4bi_fix", "pay" : 17000, "age" : 17 } |

### PATCH

| End-point | /user/:id                                                                                            |
|------------|-----------------------------------------------------------------------------------------|
| result | { "notice" : { "text" : "assigned successfully" } |
| body | { "pay" : 22000 }                                 |

### DELETE

| End-point | /user/:id                                                                                           |
|------------|-----------------------------------------------------------------------------------------|
| result | { "notice" : { "text" : "deleted successfully" } |

---

## SQL
```sql
CREATE TABLE IF NOT EXISTS `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(32) NOT NULL,
    `pay` double NOT NULL,
    `age` int(3) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `user` (`name`, `pay`, `age`) VALUES ('u4bi', 15000, 17);
INSERT INTO `user` (`name`, `pay`, `age`) VALUES ('rev', 7000, 21);
```