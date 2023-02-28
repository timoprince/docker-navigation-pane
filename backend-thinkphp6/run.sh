#!/bin/bash
docker build -t timoprince/docker-navigation-pane-backend-api .
docker-compose up -d
exit