ARG VERSION

FROM nginx:${VERSION:-1.17}-alpine as prod

COPY ./docker/nginx/prod/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/prod/default.conf /etc/nginx/conf.d/default.conf


FROM prod as dev

COPY ./docker/nginx/dev/default.conf /etc/nginx/conf.d/default.conf