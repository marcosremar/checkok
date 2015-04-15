<?php
class Conexao
{
	public function connect()
	{
		try{
			$connection = new PDO("mysql:host=127.0.0.1;dbname=meu_banco", "root", "123456");

			return $connection;
		}
		catch(PDOException $e){
			print_r($e->getMessage());
			//echo "Erro ao conectar" . $e->getMessange();

		}
	}
}
?>