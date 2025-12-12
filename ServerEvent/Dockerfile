FROM ghcr.io/sebgdf/eventinfocomreunion

USER root
RUN chmod 777 -R /home/eventinfocomreunion/src
RUN rm -fr /home/eventinfocomreunion/src

COPY ServerEvent/eventinfocomreunion/src /home/eventinfocomreunion/src
COPY ServerEvent/000-default.conf /etc/apache2/sites-available
COPY ../ENV/ /home/easydose/ENV
#RUN chmod 777 -R /home/eventinfocomreunion
#RUN php -d memory_limit=-1  /home/eventinfocomreunion/composer.phar --working-dir=/home/eventinfocomreunion/ --no-interaction --prefer-dist --optimize-autoloader install 
#\
#&& npm install && npm install --save-dev @symfony/webpack-encore webpack webpack-cli core-js
#RUN php -d memory_limit=-1  /home/easydose/composer.phar --working-dir=/home/easydose/ require api
#RUN composer require api
#RUN composer require api-platform/admin # choisir apres 0 

#RUN chown -R www-data:www-data /home/eventinfocomreunion/var && chown -R www-data:www-data /home/eventinfocomreunion/vendor \
#&& chown  www-data:www-data /home/eventinfocomreunion \
#&& chown  www-data:www-data /home
#COPY ServerEvent/event-entrypoint.sh /usr/local/bin/

#RUN dos2unix /usr/local/bin/event-entrypoint.sh
RUN chmod 777 /home/eventinfocomreunion/.env
USER www-data

ENTRYPOINT ["event-entrypoint.sh"]
CMD ["apache2-foreground"]