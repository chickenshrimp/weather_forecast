#!/bin/bash

# Default image tag
TAG="latest"

# Parse command line options
while getopts ":t:" opt; do
  case ${opt} in
    t )
      TAG=$OPTARG
      ;;
    \? )
      echo "Usage: deploy.sh [-t tag]"
      exit 1
      ;;
  esac
done

echo "Deploying Docker containers with tag: $TAG"

# Set the tag in the docker-compose.yml file
export IMAGE_TAG=$TAG

# Run Docker Compose
docker-compose down
docker-compose up --build -d
