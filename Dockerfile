FROM ghcr.io/sebastiengdf/easydose:latest
#ENV http_proxy=http://proxy.nsa.srr.fr:8080
#ENV https_proxy=http://proxy.nsa.srr.fr:8080
#RUN apt-get purge -f libxml2-dev
#RUN apt-get clean
#RUN apt-get update
#RUN apt-get install -y --fix-missing libxml2 libxml2-dev
#RUN apt-get install -y ssh
RUN rm -fr /home/easydose/src
COPY ./ServeurWEB/src /home/easydose/src
COPY ./ServeurWEB/web/assets/images /home/easydose/web/assets/images 
RUN chmod 777 -R /home/easydose/web/assets/images/dispositifeasydose
COPY ENV/DEV/parameters.yml /home/easydose/app/config
COPY ENV/DEV/parameters.yml.dist /home/easydose/app/config
COPY 000-default.conf /etc/apache2/sites-available

#RUN echo "Acquire {    ">>/etc/apt/apt.conf.d/proxy.conf
#RUN echo ' HTTP::proxy "http://proxy.srr.fr:880";  '>>/etc/apt/apt.conf.d/proxy.conf
#RUN echo 'HTTPS::proxy "http://proxy.srr.fr:880"; '>>/etc/apt/apt.conf.d/proxy.conf
#RUN echo '} '>>/etc/apt/apt.conf.d/proxy.conf
RUN apt-get update
#RUN apt -y install ca-certificates apt-transport-https
#RUN apt-get update && apt-get -y install gpg && echo -n 'deb http://ppa.launchpad.net/ondrej/php/ubuntu groovy main' > /etc/apt/sources.list.d/ondrej-ubuntu-php-groovy.list && \
 #       apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 14AA40EC0831756756D7F66C4F4EA0AAE5267A6C
#RUN docker-php-ext-install pdo_mysql 

#RUN docker-php-ext-install xml
#RUN a2enmod rewrite
#RUN apt-get -y install libpng-dev
#RUN docker-php-ext-install gd
#RUN apt-get install -y git
#RUN apt-get install -y zip
#RUN php -d memory_limit=-1  /home/easydose/composer.phar --working-dir=/home/easydose/ --no-suggest install

#RUN echo "#!/bin/sh" > /etc/rc0.d/K01cacheclear.sh
#RUN echo "### BEGIN INIT INFO">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "# Provides:          cacheclear">> /etc/rc0.d/K01cacheclear.sh
#RUN echo '# Required-Start:    $local_fs $remote_fs $network $syslog $named' >> /etc/rc0.d/K01cacheclear.sh
#RUN echo '# Required-Stop:     $local_fs $remote_fs $network $syslog $named' >> /etc/rc0.d/K01cacheclear.sh
#RUN echo "# Default-Start:     2 3 4 5">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "# Default-Stop:      0 1 6">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "# X-Interactive:     true">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "# Short-Description: Apache2 web server">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "# Description:       Start the web server">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "#  This script will start the apache2 web server.">> /etc/rc0.d/K01cacheclear.sh
#RUN echo "### END INIT INFO">> /etc/rc0.d/K01cacheclear.sh
#RUN echo " ">> /etc/rc0.d/K01cacheclear.sh
RUN echo "php /home/easydose/bin/console cache:clear --env=dev">> /etc/rc0.d/K01cacheclear.sh
RUN echo "chmod 777 -R /home/easydose/var">> /etc/rc0.d/K01cacheclear.sh
RUN echo "cd /home/easydose && php bin/console assets:install">> /etc/rc0.d/K01cacheclear.sh
RUN echo "exit 0" >> /etc/rc0.d/K01cacheclear.sh
RUN chmod 777  /etc/rc0.d/K01cacheclear.sh
#RUN sh /etc/rc0.d/K01cacheclear.sh
RUN sed -i 's/output_buffering = 4096/output_buffering = 9096/g' $PHP_INI_DIR/php.ini-development
RUN sed -i 's/memory_limit = 128M/memory_limit = 2G/g' $PHP_INI_DIR/php.ini-development
RUN sed -i 's/output_buffering = 4096/output_buffering = 9096/g' $PHP_INI_DIR/php.ini-production
RUN sed -i 's/memory_limit = 128M/memory_limit = 2G/g' $PHP_INI_DIR/php.ini-production
RUN sed -i 's/max_execution_time = 30/max_execution_time = 240/g' $PHP_INI_DIR/php.ini-production
RUN sed -i 's/max_execution_time = 30/max_execution_time = 240/g' $PHP_INI_DIR/php.ini-development

RUN cp $PHP_INI_DIR/php.ini-production /usr/local/etc/php/php.ini
RUN a2enmod proxy_http
ENTRYPOINT ["/bin/sh", "-c" ,"/etc/rc0.d/K01cacheclear.sh && apache2-foreground"]
