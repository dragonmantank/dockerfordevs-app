FROM ubuntu:14.04
MAINTAINER Chris Tankersley <chris@ctankersley.com>

RUN apt-get update && apt-get install -y \
	nginx

COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]