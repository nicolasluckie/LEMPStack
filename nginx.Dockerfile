FROM nginx:1.23.3
LABEL author="Nicolas Luckie <nicolasluckie@gmail.com>"

# Copy configuraton
COPY /config/nginx-default.conf /etc/nginx/conf.d/default.conf

# Copy content
COPY /app/ /usr/share/nginx/html
