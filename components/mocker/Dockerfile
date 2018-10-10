FROM ubuntu:18.10

RUN apt-get update \
    && apt-get upgrade -yq \
    && apt-get install -yq \
    apt-transport-https \
    ca-certificates \
    software-properties-common \
    curl \
    --no-install-recommends && \
    apt-get clean && apt-get purge && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD src/ /

CMD ["/mocker/mocker.sh"]
