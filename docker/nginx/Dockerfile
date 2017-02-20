FROM ubuntu:14.04
MAINTAINER Chris Tankersley <chris@ctankersley.com>

RUN apt-get update && apt-get install -y \
	nginx

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./html /var/www/html

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]