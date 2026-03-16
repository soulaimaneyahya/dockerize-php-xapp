FROM redis:7.4.2-alpine

ENV REDIS_PORT=${REDIS_PORT}
ENV REDIS_MAXMEMORY=${REDIS_MAXMEMORY}
ENV REDIS_DATABASES=${REDIS_DATABASES}

COPY ./redis.conf /usr/local/etc/redis/redis.conf

EXPOSE ${REDIS_PORT}

# Run Redis with authentication and specified settings
CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]
