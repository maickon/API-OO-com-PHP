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
	$sql->setRowData('id', 5);
	$sql->setRowData('nome', 'OpenGl');
	$sql->setRowData('autor', 'Steve Woz');

	$conn = TTransaction::get();
	$resul = $conn->query($sql->getInstruction());
	TTransaction::log($sql->getInstruction());

	//-----------------------------------------------

	TTransaction::setLogger(new TLoggerXML('tmp/arquivo.xml'));
	TTransaction::log("Inserindo registro de Albert Eintein");

	$sql = new TSqlInsert();
	$sql->setEntity('livros');
	$sql->setRowData('id', 6);
	$sql->setRowData('nome', 'Criando a Apple');
	$sql->setRowData('autor', 'Steve Jobs');

	$conn = TTransaction::get();
	$resul = $conn->query($sql->getInstruction());
	TTransaction::log($sql->getInstruction());
	TTransaction::close();
}catch(Exception $e){
	echo $e->getMessage();
	TTransaction::rollback();
}
?>