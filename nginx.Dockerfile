FROM nginx:alpine
RUN echo 'start' \
    && rm -f /etc/nginx/conf.d/default.conf \
    && rm -rf /tmp/twig \
    && mkdir -p /tmp/twig/site \
    && chown -R nginx: /tmp/twig \
    && chmod -R 0777 /tmp/twig\
    && echo 'done'
