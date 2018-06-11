D:\wamp64\bin\mysql\mysql5.7.19\bin\mysqldump -d --comments=FALSE -u root wp_woo_sneaker  > 1_schema.sql
D:\wamp64\bin\mysql\mysql5.7.19\bin\mysqldump -t --order-by-primary --comments=FALSE -u root wp_woo_sneaker  > 2_init_data.sql
