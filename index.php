<?php
require('Conexao.php');
require('Pesquisa.php');
require('SoapTempConvert.php');

//Se o formulario for submetido
if($_SERVER['REQUEST_METHOD']=='POST'){
	$conn = new Conexao();
	$conexao = $conn->connect();
	$pesquisa = new Pesquisa($conexao);

	//Substitui virgula inserida pelo usuario por ponto
	$_POST['requisicao_temperatura'] = str_replace(',', '.', $_POST['requisicao_temperatura']);

	$TempConvert = new SoapTempConvert();
	switch($_POST['requisicao_tipo']){
		case 'f':
			$result = $TempConvert->CelsiusToFahrenheit($_POST['requisicao_temperatura']);
			$labelFahrenheit = number_format($result->CelsiusToFahrenheitResult, 1, ',', '.');
			$message = "{$_POST['requisicao_temperatura']} Celsius equivale a {$labelFahrenheit} Fahrenheit.";

			//Grava dados da pesquisa
			$new_record = array(
				'requisicao_temperatura' => $_POST['requisicao_temperatura'],
				'requisicao_tipo' => 'f',
				'resposta_temperatura' => $result->CelsiusToFahrenheitResult,
				'ip_requisitante' => $_SERVER['REMOTE_ADDR'],
				'xml_gerado' => $TempConvert->client->__getLastRequest()
			);
			$pesquisa->inserir($new_record);

			break;
		case 'c':
			$result = $TempConvert->FahrenheitToCelsius($_POST['requisicao_temperatura']);
			$labelCelsius = number_format($result->FahrenheitToCelsiusResult, 1, ',', '.');
			$message = "{$_POST['requisicao_temperatura']} Fahrenheit equivale a {$labelCelsius} Celsius.";

			//Grava dados da pesquisa
			$new_record = array(
				'requisicao_temperatura' => $_POST['requisicao_temperatura'],
				'requisicao_tipo' => 'c',
				'resposta_temperatura' => $result->FahrenheitToCelsiusResult,
				'ip_requisitante' => $_SERVER['REMOTE_ADDR'],
				'xml_gerado' => $TempConvert->client->__getLastRequest()
			);
			$pesquisa->inserir($new_record);

			break;
		default:
			print_r('O tipo de conversao nao foi informado!');
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Pesquisa de Graus Celsius e Fahrenheit</title>
	<style>
		p.message_box{
			background-color: #57E964;
			padding: 5px;
		}
	</style>
	<script>
		var ValidationForm = function (){
			var valid = true;
			var temp = document.getElementById("requisicao_temperatura").value;
			var celsius = document.getElementById("radio_celsius").checked;
			var fahrenheit = document.getElementById("radio_fahrenheit").checked;

			var regex_temp = /^\d+\,?\d+$/;

			if(!regex_temp.test(temp)){
				valid = false;
			}
			
			if( !celsius && !fahrenheit){
				valid = false;
			}

			if(!valid){
				alert("Preencha o formulario corretamente!");
			}

			return valid;
		};
	</script>
</head>
<body>
<header>
	<h1>Pesquisa de Graus Celsius e Fahrenheit</h1>
</header>

<section>

<?php if(isset($message)):?>
    <p class="message_box">
    	<?php echo $message;?>
    </p>
	<?php endif;?>

<form action="" method="post" onsubmit="return ValidationForm()">
  <fieldset>
  	<legend>Nova Pesquisa</legend>
    
	<p>
    	<label for="radio">Temperatura requisitada:</label> <input type="text" name="requisicao_temperatura" id="requisicao_temperatura">
    </p>
    <p>
	    <label for="box_radio">Converter para:</label></br>
	    <input type="radio" name="requisicao_tipo" id="radio_celsius" value="c"> <label for="radio">Celsius -> Fahrenheit</label>
	    <input type="radio" name="requisicao_tipo" id="radio_fahrenheit" value="f"> <label for="radio">Fahrenheit -> Celsius</label>
    </p>
    <p>
		<input type="submit" value="Consultar">
    </p>
  </fieldset>
</form>
</section>

<footer>
<p>Desenvolvido por Marcos Antonio</p>
</footer>

</body>
</html>