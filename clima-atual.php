<?php

# Autoload de classes
require __DIR__."/vendor/autoload.php";

# Dependências
use \App\WebService\OpenWeatherMap;

# Instância da API
$obOpenWeatherMap = new OpenWeatherMap("d4696918d77ab48b666774803bd4cc53");

/*
# Verifica argumentos
if(!isset($argv[2])){
    die("Cidade e UF são obrigatórios");
}
$cidade = $argc[1];
$uf = $argv[2];
*/

# Variáveis
$cidade = "Santa Cruz do Sul";
$uf = "RS";

# Executa consulta na API
$dadosClima = $obOpenWeatherMap->consultarClimaAtual($cidade, $uf);

# Cidade
echo "Cidade: " .$cidade. "/" .$uf."\n";

# Temperatura
echo "Temperatura: " .($dadosClima["main"]["temp"] ?? "Desconhecido")."\n";
echo "Sensação Térmica: " .($dadosClima["main"]["feels_like"] ?? "Desconhecido")."\n";

# Clima
echo "Clima: " .($dadosClima["weather"][0]["description"] ?? "Desconhecido")."\n";

// echo "<pre>";
// print_r($dadosClima);
// echo "</pre>"; exit;