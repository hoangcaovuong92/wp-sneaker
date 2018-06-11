#!/bin/bash

NAME=wp_woo_sneaker

REV=`svn info | grep "Revision" | awk '{print $2}'`
VER=4.9.x
# clean up
rm -Rf $NAME-full-package $NAME-full-package.zip $NAME $NAME.zip

# export code from local repository
svn --ignore-externals export ../ $NAME-full-package/

# copy database files
cat $NAME-full-package/db/1_schema.sql $NAME-full-package/db/2_init_data.sql $NAME-full-package/db/3_BUILD_update_config.sql > sample-database.sql

# remove non-disclosed files
rm -Rf $NAME-full-package/db $NAME-full-package/build

# create $NAME-full-package.zip
zip -rq $NAME-full-package_$VER\_r$REV.zip $NAME-full-package/ sample-database.sql
echo "Created $NAME-full-package_$VER\_r$REV.zip"

### create $NAME-theme-package.zip {{{
mkdir $NAME
# theme
mv $NAME-full-package/wp-content/themes/$NAME/* $NAME/
mkdir $NAME/cache_theme
#mv sample-data.xml $NAME/sample-data.xml

zip -rq $NAME\_r$REV.zip $NAME

#zip -rq $NAME-theme-package_$VER\_r$REV.zip $NAME-theme-package/ sample-data-theme-package.xml

echo "Created $NAME\_r$REV.zip"
### }}}

#clean up
rm -Rf $NAME
rm -Rf $NAME-full-package
rm -Rf sample-database.sql