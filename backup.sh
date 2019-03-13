#!/bin/bash
currentDatetime=$(date +'%d%m%y%H%M%S')
tar -czvf /home/nomeDeUsuario/backups/backup_$currentDatetime.tar.gz /home/nomeDeUsuario --exclude /home/nomeDeUsuario/backups