<?php

class Sql extends PDO{
	private $conexao;

	public function __construct()
	{
		$this->conexao = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "1234");
	}

	private function setParams($statement, $parameters = [])
	{
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}

	public function query($rawQuery, $params = [])
	{
		$stmt = $this->conexao->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery, $params = []):array
	{
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>