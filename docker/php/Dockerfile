ARG IMAGE="php:latest"
FROM ${IMAGE}

ARG PROJECT_DIR=/opt/ant-api

ENV UNAME="developer"
ENV UID=1000
ENV GID=1000

# Expose server port
EXPOSE 8000

# Install meta-dependencies from APT
RUN apt-get update && apt-get install -y \
    git \
    sudo \
    zip \
    unzip\
 && rm -rf /var/lib/apt/lists/*

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/bin/composer \
 && chmod +x /usr/bin/composer

# Install symfony
RUN php -r "copy('https://get.symfony.com/cli/installer', 'installer.sh');" \
 && bash ./installer.sh \
 && mv /root/.symfony/bin/* /usr/local/bin \
 && rm -R /root/.symfony

# Configure development environment
RUN mkdir -p "${PROJECT_DIR}"
WORKDIR ${PROJECT_DIR}
COPY docker-entrypoint.sh /usr/bin/
ENTRYPOINT ["/usr/bin/docker-entrypoint.sh"]
CMD ["symfony", "server:start", "--no-tls", "--allow-http", "--port=8000"]
