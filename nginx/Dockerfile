FROM nginx:alpine

WORKDIR /var/www/html

COPY ./nginx.conf /etc/nginx/nginx.conf

ENV SERVER_PORT=80

EXPOSE 80

# runs Nginx in the foreground within the container
# flag prevents Nginx from running as a background process, ensuring it stays active and doesn't exit immediately
CMD ["nginx", "-g", "daemon off;"]
