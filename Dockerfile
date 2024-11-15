FROM nginx:alpine
#COPY src/html /var/www/sample

COPY src/html /usr/share/nginx/html

# ENV PRODUCTION=true

# this is really just documentation
EXPOSE 9000

# nginx defaults to this command
# CMD ["nginx", "-g", "daemon off;"]
