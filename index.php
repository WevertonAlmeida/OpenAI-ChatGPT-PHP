<?php
  // Use Guzzle to make HTTP requests
  require 'vendor/autoload.php';
  use GuzzleHttp\Client;
  
  $client = new Client();
  
  $response = $client->post('https://api.openai.com/v1/engines/text-davinci-003/completions', [
	  'headers' => [
		  'Authorization' => 'Bearer <API_KEY>',
		  'Content-Type' => 'application/json',
	  ],
	  'json' => [
		  'prompt' => "Sugerir apenas nomes de <COLOCAR O QUE DESEJA PESQUISAR> da marca ".$_POST['sub_item']."? Formatar o resultado separando os nomes dos itens com vírgula. ",
		  'max_tokens' => 100,
		  'temperature' => 0.5,
	  ],
  ]);

  $completions = json_decode($response->getBody()->getContents())->choices[0]->text;
  $exames = explode(", ", $completions);

  $resposta = "Itens da marca ".$_POST['sub_item'].":<br />";
  
  foreach ($exames as $exame) {
	  $resposta .= "- " . $exame . "<br>";
  }

  echo $resposta;
?>