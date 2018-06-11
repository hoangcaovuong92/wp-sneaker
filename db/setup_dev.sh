mysqladmin -u root drop wp_woo_sneaker
mysqladmin -u root create wp_woo_sneaker
mysql -u root wp_woo_sneaker < 1_schema.sql
mysql -u root wp_woo_sneaker < 2_init_data.sql
