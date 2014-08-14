<?php

function __autoload($classe){
	if(file_exists("app.dbo/{$classe}.class.php")):
		require_once "app.dbo/{$classe}.class.php";
	endif;
}

try{
	TTransaction::open('my_livro');
	TTransaction::setLogger(new TLoggerHTML('tmp/arquivo.html'));
	TTransaction::log("Inserindo registro de Maickon Rangel");

	$sql = new TSqlInsert();
	$sql->setEntity('livros');
	$sql->setRowData('id', 3);
	$sql->setRowData('nome', 'Programando com PHP 2');
	$sql->setRowData('autor', 'Maickon Rangel');

	$conn = TTransaction::get();
	$resul = $conn->query($sql->getInstruction());
	TTransaction::log($sql->getInstruction());

	//-----------------------------------------------

	TTransaction::setLogger(new TLoggerXML('tmp/arquivo.xml'));
	TTransaction::log("Inserindo registro de Albert Eintein");

	$sql = new TSqlInsert();
	$sql->setEntity('livros');
	$sql->setRowData('id', 4);
	$sql->setRowData('nome', 'Fisica basica');
	$sql->setRowData('autor', 'Albert luiz');

	$conn = TTransaction::get();
	$resul = $conn->query($sql->getInstruction());
	TTransaction::log($sql->getInstruction());
	TTransaction::close();
}catch(Exception $e){
	echo $e->getMessage();
	TTransaction::rollback();
}
?>