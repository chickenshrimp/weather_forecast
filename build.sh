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
      echo "Usage: build.sh [-t tag]"
      exit 1
      ;;
  esac
done

echo "Building Docker images with tag: $TAG"

# Build the PHP image
docker build -t symfony_php:$TAG -f Dockerfile .