#!/bin/bash
npm run build
docker build -t timoprince/docker-navigation-pane-admin .
docker-compose up -d
exit