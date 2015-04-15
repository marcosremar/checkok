<?php
class SoapTempConvert
{
	public $client;
	public function __construct()
	{
		try{
			$this->client = new SoapClient('http://www.w3schools.com/webservices/tempconvert.asmx?WSDL',array('trace' => true));
		}
		catch(Exception $e){
			print_r($e->getMessage());
			echo "Soap error: " . $e->getMessange();
		}
	}

	public function CelsiusToFahrenheit($requisicao_temperatura)
	{
		$function = 'CelsiusToFahrenheit';
		$arguments = array(
				'CelsiusToFahrenheit' => array(
					'Celsius' => $requisicao_temperatura,
				));				
		$options = array('location' => 'http://www.w3schools.com/webservices/tempconvert.asmx');

		$result = $this->client->__soapCall($function, $arguments, $options);

		if(is_soap_fault($result)){
			trigger_error("SOAP Fault: (faultcode: {$result->faultcode},
			faultstring: {$result->faultstring})", E_ERROR);
		}else{
			return $result;
		}
	}

	public function FahrenheitToCelsius($requisicao_temperatura)
	{
		$function = 'FahrenheitToCelsius';
		$arguments = array(
				'FahrenheitToCelsius' => array(
					'Fahrenheit' => $requisicao_temperatura,
				));				
		$options = array('location' => 'http://www.w3schools.com/webservices/tempconvert.asmx');

		$result = $this->client->__soapCall($function, $arguments, $options);

		if(is_soap_fault($result)){
			trigger_error("SOAP Fault: (faultcode: {$result->faultcode},
			faultstring: {$result->faultstring})", E_ERROR);
		}else{
			return $result;
		}
	}

}
?>