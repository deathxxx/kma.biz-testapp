kma.biz test app 
=====================
run 
```docker-compose up```

open http://0.0.0.0:85

step 1 - init db run: http://0.0.0.0:85/init.php

step 2 - run: http://0.0.0.0:85/send.php

step 3 - run: http://0.0.0.0:85/queue.php - this command must run from console

run docker in terminal - kma.biz_php_id - is container id
```
docker ps 
docker exec -it <kma.biz_php_id> bash
php queue.php
``` 

step 4 - view report - run: http://0.0.0.0:85/report.php
