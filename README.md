# Introduction
Its an API that takes products in arbitrary order (similar to a checkout line) and then returns the correct final price for the entire shopping basket based on the prices as applicable.

# Pre-Installation Requirements
Install Docker - https://www.docker.com/get-started

# Installation
Run `make init` in the terminal

# Useful commands
- `make start` - runs the docker container
- `make stop` - stops the docker container
- `make exec` - enters the docker container

# Running tests
Enter the container with `make exec` and run `composer test` command.

# Linting
Enter the container with `make exec` and run `composer check` command.