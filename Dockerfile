# For more information, please refer to https://aka.ms/vscode-docker-python
FROM python:3.8-slim

EXPOSE 8000

# Keeps Python from generating .pyc files in the container
ENV PYTHONDONTWRITEBYTECODE=1

# Turns off buffering for easier container logging
ENV PYTHONUNBUFFERED=1

RUN apt-get update
RUN apt-get install -y make automake gcc g++ subversion python3-dev bash watchman git
RUN rm -fr /var/cache/apk/*

# Install pip requirements
RUN mkdir /code
COPY requirements.txt /code/
WORKDIR /code

RUN pip3 install --upgrade pip && pip3 install -r requirements.txt
COPY . /code/
