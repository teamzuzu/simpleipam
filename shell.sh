docker buildx build -t ipam .  &&  docker run --network=host -it --rm ipam bash
