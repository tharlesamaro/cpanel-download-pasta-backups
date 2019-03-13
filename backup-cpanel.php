<?php

const FTP_SERVIDOR = "";
const FTP_USUARIO = "";
const FTP_SENHA = "";
const CPANEL_PATH_BACKUP = "";
const LOCALHOST_PATH_BACKUP = "";
const NOME_TXT_LOG = LOCALHOST_PATH_BACKUP . "log.txt";

function getNomeDoBackupParaDownload($listaDosBackupsNoCpanel)
{
	$nomeDoBackup = null;	
	
	foreach($listaDosBackupsNoCpanel as $backup) {		
		$arquivoValido = $backup['name'] != "." and $backup['name'] != "..";		
		$arquivoNaoExisteLocalmente = !file_exists(LOCALHOST_PATH_BACKUP . $backup['name']);
		
		if($arquivoNaoExisteLocalmente and $arquivoValido) {
			$nomeDoBackup = $backup['name'];
			break;
		}
	}	
	return $nomeDoBackup;
}

function escreverLog($texto)
{
	$fp = fopen(NOME_TXT_LOG, "a+");
	fwrite($fp, $texto);
	fclose($fp);
}

function ftpDownload()
{
    $conexaoId = ftp_connect(FTP_SERVIDOR) or die("Não foi possível conectar-se a " . FTP_SERVIDOR);
	
    if (@ftp_login($conexaoId, FTP_USUARIO, FTP_SENHA)) {	
	
		ftp_pasv($conexaoId, true);

        $listaDosBackupsNoCpanel = ftp_mlsd($conexaoId, CPANEL_PATH_BACKUP);
		
		$nomeDoBackupParaDownload = getNomeDoBackupParaDownload($listaDosBackupsNoCpanel);
		
		$arquivoLocal = LOCALHOST_PATH_BACKUP . $nomeDoBackupParaDownload;
		$arquivoCpanel = CPANEL_PATH_BACKUP . $nomeDoBackupParaDownload;
		
		if (ftp_get($conexaoId, $arquivoLocal, $arquivoCpanel, FTP_BINARY)) {
			escreverLog("Arquivo " . $nomeDoBackupParaDownload . " salvo com sucesso na data " . date('d/m/Y') . "\n");
		}
		else {
			escreverLog("Houve um erro ao fazer o backup na data " . date('d/m/Y') . "\n");
		}
    }
	else {
		escreverLog("Não foi possível conectar como " . FTP_USUARIO . "\n");
    }
	
    ftp_close($conexaoId);
}

ftpDownload();
