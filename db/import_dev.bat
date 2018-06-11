D:\xampp\mysql\bin\mysqladmin -u root drop wp_woo_sneaker
D:\xampp\mysql\bin\mysqladmin -u root create wp_woo_sneaker
D:\xampp\mysql\bin\mysql -u root wp_woo_sneaker < 1_schema.sql
D:\xampp\mysql\bin\mysql -u root wp_woo_sneaker < 2_init_data.sql