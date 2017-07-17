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
			$this->setData($results[0]);
		}
	}
	public static function getList()
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM usuarios ORDER BY deslogin");
	}
	public function search($login)
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", [":SEARCH" => "%" . $login . "%"]);
	}
	public function login($login, $password)
	{
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM usuarios WHERE deslogin = :LOGIN and dessenha = :PASSWORD", [":LOGIN"=>$login,
						 ":PASSWORD"=>$password]);
		if (count($results) > 0){
			$this->setData($results[0]);
		}else{
			throw new Exception("Login e/ou senha inválido");
		}
	}
	public function setData($data)
	{
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}
	public function insert()
	{
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", [
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
			]);
		if (count($results) > 0){
			$this->setData($results[0]);
		}
	}
	public function update($login, $password)
	{
		$this->setDeslogin($login);
		$this->setDessenha($password);
		
		$sql = new Sql();
		$sql->query("UPDATE usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD  WHERE idusuario = :ID", [':LOGIN'=>$this->getDeslogin(), ':PASSWORD'=>$this->getDessenha(), ':ID'=>$this->getIdusuario()]);
	}
	public function __construct($login = "", $password = "")
	{
		$this->setDeslogin($login);
		$this->setDessenha($password);
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