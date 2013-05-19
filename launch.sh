#!/bin/sh

if [ "$1" = "bot" ]; then
        php run.php
        sleep 1
elif [ "$1" = "loop" ]; then
        while true; do
                echo "SinZBot starting."
                $0 bot
                echo "SinZBot went down. Restarting..."
        done
else
        screen -D -R -S SinZBot $0 loop
fi
