#!/bin/bash

for i in $(grep -l -R "ondeck" /var/app/ondeck/var/cache/prod/*); do
    sed -i -e "s/\/var\/app\/ondeck/\/var\/app\/current/g" $i
done
