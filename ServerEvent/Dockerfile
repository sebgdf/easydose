FROM php:8.3-apache




RUN apt-get update
RUN docker-php-ext-install pdo_mysql 
RUN a2enmod rewrite
RUN a2enmod headers

RUN sed -i 's/output_buffering = 4096/output_buffering = 9096/g' $PHP_INI_DIR/php.ini-development
RUN sed -i 's/memory_limit = 128M/memory_limit = 2G/g' $PHP_INI_DIR/php.ini-development
RUN sed -i 's/output_buffering = 4096/output_buffering = 9096/g' $PHP_INI_DIR/php.ini-production
RUN sed -i 's/memory_limit = 128M/memory_limit = 2G/g' $PHP_INI_DIR/php.ini-production
RUN sed -i 's/max_execution_time = 30/max_execution_time = 240/g' $PHP_INI_DIR/php.ini-production
RUN sed -i 's/max_execution_time = 30/max_execution_time = 240/g' $PHP_INI_DIR/php.ini-development

RUN cp $PHP_INI_DIR/php.ini-production /usr/local/etc/php/php.ini

RUN mkdir /home/eventinfocomreunion
COPY ServerEvent/eventinfocomreunion /home/eventinfocomreunion
COPY ServerEvent/000-default.conf /etc/apache2/sites-available
COPY ../ENV/DEV/.env /home/easydose/
RUN rm -fr /home/eventinfocomreunion/var
RUN rm -fr /home/eventinfocomreunion/vendor
RUN rm -fr /home/eventinfocomreunion/nodes_modules
#RUN rm -fr /home/eventinfocomreunion/assets
RUN chown -R www-data:www-data /home/eventinfocomreunion
RUN apt-get install -y git

#RUN chmod 777 -R /home/eventinfocomreunion
RUN php -d memory_limit=-1  /home/eventinfocomreunion/composer.phar --working-dir=/home/eventinfocomreunion/ --no-interaction --prefer-dist --optimize-autoloader install
#RUN php -d memory_limit=-1  /home/easydose/composer.phar --working-dir=/home/easydose/ require api
#RUN composer require api
#RUN composer require api-platform/admin # choisir apres 0 
USER www-data

