#!/bin/sh
echo "env = $env"
cat /home/easydose/ENV/$env/.env > /home/eventinfocomreunion/.env

exec "$@"