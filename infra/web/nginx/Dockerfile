FROM nginx:alpine

WORKDIR /usr/share/nginx/html

COPY ./nginx.conf /etc/nginx/nginx.conf

EXPOSE ${SERVER_PORT}

# runs Nginx in the foreground within the container
# flag prevents Nginx from running as a background process, ensuring it stays active and doesn't exit immediately
CMD ["nginx", "-g", "daemon off;"]
