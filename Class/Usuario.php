<?php 
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario():int
	{
		return $this->idusuario;
	}
	public function setIdusuario($idusuario)
	{
		$this->idusuario = $idusuario;
	}
	public function getDeslogin():string
	{
		return $this->deslogin;
	}
	public function setDeslogin($deslogin)
	{
		$this->deslogin = $deslogin;
	}
	public function getDessenha():string
	{
		return $this->dessenha;
	}
	public function setDessenha($dessenha)
	{
		$this->dessenha = $dessenha;
	}
	public function getDtcadastro():DateTime
	{
		return $this->dtcadastro;
	}
	public function setDtcadastro($dtcadastro)
	{
		$this->dtcadastro = $dtcadastro;	
	}
	public function loadById($id)
	{
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM usuarios WHERE idusuario = :ID", [":ID"=>$id]);
		if (count($results) > 0){
			$row = $results[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}
	public function __toString()
	{
		return json_encode([
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			]);
	}
}
?>