FROM nginx:1.27.4-alpine

WORKDIR /usr/share/nginx/html

COPY ./fastcgi_params /etc/nginx/fastcgi_params

COPY ./nginx.conf /etc/nginx/nginx.conf

EXPOSE ${SERVER_PORT}

# runs Nginx in the foreground within the container
# flag prevents Nginx from running as a background process, ensuring it stays active and doesn't exit immediately
CMD ["nginx", "-g", "daemon off;"]
