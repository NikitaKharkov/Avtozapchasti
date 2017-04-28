FROM nginx:stable

ADD nginx.conf /etc/nginx/

COPY ssl /etc/nginx/ssl/

RUN usermod -u 1000 www-data
