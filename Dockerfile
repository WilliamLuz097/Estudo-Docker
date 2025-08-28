#---Etapa 1: PHP-FPM ---#
# Usa a imagem oficial do PHP como base, com FPM e Alpine, que é menor e mais segura.
FROM php:8.3-fpm-alpine AS php_base

# Defino o criador da imagem.
LABEL maintainer="William <william@teste.com.br>"

# Diretório de trabalho dentro do contêiner para utilização da aplicação.
WORKDIR /var/www/html

# Instala as dependências do sistema e as extensões PHP essenciais.
# As extensões são instaladas com o 'docker-php-ext-install' para garantir compatibilidade.

# Instala as dependências do sistema.
RUN apk add --no-cache \
    curl \
    libzip \
    libpng \
    libjpeg-turbo \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev

# Instala as extensões do PHP.
RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    gd \
    mbstring \
    opcache

# Instala o Composer, que é um gerenciador de dependências para PHP.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#--- Etapa 2: Nginx ---#
# Estou usando uma imagem oficial do Nginx com Alpine como base.
FROM nginx:alpine AS nginx_base

# Defino o criador da imagem.
LABEL maintainer="William <william@teste.com.br>"

# Remoção da configuração padrão do Nginx para evitar conflitos ao iniciar o serviço.
RUN rm /etc/nginx/conf.d/default.conf

# Copia da configurações personalizada do Nginx para o contêiner.
COPY nginx.conf /etc/nginx/nginx.conf

# Copia a configuração de servidor personalizada para o domínio 'william.teste.com.br'
COPY william.teste.com.br.conf /etc/nginx/conf.d/william.teste.com.br.conf

# Informo/divulgo a porta 80, essa porta é a padrão para o tráfego HTTP.
EXPOSE 80

# Comando para iniciar o Nginx quando o contêiner for executado
CMD ["nginx", "-g", "daemon off;"]