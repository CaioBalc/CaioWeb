<?php

namespace App\WebService;

class OpenWeatherMap{
    /**
     * URL base das APIs
     * @var string
     */

    const BASE_URL = "https://api.openweathermap.org";
    
    /**
     * Chave de acesso da API
     * @var string
     */

    private $apiKey;

    /**
     * Método que constói classe definindo a chave de API
     * @param string
     */

    public function __construct($apiKey){
        $this->apiKey = $apiKey;
    }
    /**
     * Método que obtém clima atual de cidade no Brasil
     * @param string $cidade
     * @param string $uf
     * @param array
     */
    public function consultarClimaAtual($cidade, $uf){
        return $this->get("/data/2.5/weather", ["q"=> $cidade.",BR-".$uf.",BRA"]);
    }

    /**
     * Método que executa consulta GET na API
     * @param string $resource
     * @param array $params
     * @return array
     */
    private function get($resource, $params = []){
        # Parâmetros adicionais
        $params["units"] = "metric";
        $params["lang"] = "pt";
        $params["appid"] = $this->apiKey;
        
        # EndPoint
        $endpoint = self::BASE_URL.$resource."?".http_build_query($params);

        # Inicia Curl
        $curl = curl_init();

        # Configurações Curl
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET"
        ]);

        # Response
        $response = curl_exec($curl);

        #Início HTTP
        # HTTP Status Code
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        # Print HTTP Status Code
        #echo "HTTP Status Code: " . $httpcode . "\n";

        # Print Full Response
        #echo "Full Response: \n";
        #print_r(json_decode($response, true));
        #Fim HTTP

        # Fecha conexão Curl
        curl_close($curl);

        # Response em array
        return json_decode($response, true);
    }
}