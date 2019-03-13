# Script para automatizar o backup full de uma hospedagem CPanel

* Adicione uma pasta com o nome "backups" na home do Cpanel

* Faça upload do arquivo [backup.sh](https://github.com/tharlesamaro/cpanel-backups-automatizados/blob/master/backup.sh) para a home do Cpanel e altere as permissões do script para 750

* Implemente a cron para executar o script uma vez a cada dia

  * **Minuto:** 0
  * **Hora:** 0
  * **Dia:** *
  * **Mês:** *
  * **Dia da semana:** *
  * **Comando:** /home/usuarioCpanel/backup.sh
  
# Script para automatizar o download dos backups no Cpanel via FTP

* Faça download do arquivo [backup-cpanel.php](https://github.com/tharlesamaro/cpanel-backups-automatizados/blob/master/backup-cpanel.php)

* Altere as constantes do script de acordo com o suas configurações

* Copie ele para a máquina onde deseja salvar os arquivos(ou outra estação :p) e implemente uma cron para executar o arquivo uma vez a dia

* Coloque um horário que você saiba que o backup do CPanel já tenha sido realizado

* A máquina que vai executar o script precisa ter o PHP instalado

* Para testar o script via terminal, rode o comando: ```php backup-cpanel.php```
