FROM  mattrayner/lamp:latest-1804

RUN apt upgrade && apt update -y &&\
    apt install postfix -y

EXPOSE 80 3306
