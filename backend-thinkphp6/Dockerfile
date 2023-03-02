FROM webdevops/php-nginx:7.4-alpine
# 时区，utf+8=国内时间
ENV PHP_DATE_TIMEZONE=UTC+8
# 内存限制，按需调整
ENV PHP_MEMORY_LIMIT=64M
# POST请求及上传文件最大限制
ENV PHP_POST_MAX_SIZE=10M
ENV PHP_UPLOAD_MAX_FILESIZE=10M
COPY ./vhost.conf /opt/docker/etc/nginx/vhost.conf
COPY ./ /app
EXPOSE 8801
RUN chmod -R 777 /app
RUN composer2 install -d /app
