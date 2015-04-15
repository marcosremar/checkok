<?php
class Pesquisa
{
	private $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	public function listar()
	{
		$query = "SELECT * FROM pesquisa";
		$stmt = $this->db->query($query); 
		$stmt->execute();

		$data = $stmt->fetchAll();

		$arr = array();
		foreach($data as $r){
			$arr[] = array(
						'id_consulta' => $r['id_consulta'],
			 			'requisicao_temperatura' => $r['requisicao_temperatura'],
			 			'requisicao_tipo' => $r['requisicao_tipo'],
			 			'resposta_temperatura' => $r['resposta_temperatura'],
			 			'datahora_consulta' => $r['datahora_consulta'],
			 			'ip_requisitante' => $r['ip_requisitante'],
			 			'xml_gerado' => $r['xml_gerado'],
			 		);
		}
		return $arr;
	}

	public function inserir($data){
		$query = "INSERT INTO meu_banco.pesquisa (requisicao_temperatura,requisicao_tipo,resposta_temperatura,datahora_consulta,ip_requisitante,xml_gerado) ".
				 "VALUES (:requisicao_temperatura, :requisicao_tipo, :resposta_temperatura, NOW(), :ip_requisitante, :xml_gerado)";
		$stmt = $this->db->prepare($query);

		$stmt->bindParam(":requisicao_temperatura",$data['requisicao_temperatura']);
		$stmt->bindParam(":requisicao_tipo",$data['requisicao_tipo'],PDO::PARAM_STR);
		$stmt->bindParam(":resposta_temperatura",$data['resposta_temperatura']);
		$stmt->bindParam(":ip_requisitante",$data['ip_requisitante'],PDO::PARAM_STR);
		$stmt->bindParam(":xml_gerado",$data['xml_gerado']);

		$stmt->execute();
	}

}

?>