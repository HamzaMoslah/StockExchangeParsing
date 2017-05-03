<?php
// import dom parser file 
include('simple_html_dom.php');

$html = file_get_html('http://www.poste.tn/change.php');
       
$indice=0;
$obj = new stdClass();
$response=array();
$object=array("nom"=>"","code"=>"","unit"=>"","sell"=>0,"buy"=>0);

foreach($html->find('td.cel_contenu') as $e){
	switch($indice){
				case 0:
					$object['nom']=$e->innertext;
				break;
				case 1:
					$object['code']=$e->innertext;
				break;
				case 2:
					$object['unit']=$e->innertext;

				break;
				case 3:
					$object['sell']=$e->innertext;
				break;
				case 4:
					$object['buy']=$e->innertext;
					array_push($response,$object);
					$object=array("nom"=>"","code"=>"","sell"=>0,"buy"=>0);
				break;
	}
		$indice=($indice+1)%5;
}
$obj->cours=$response;
echo(json_encode($obj));
?>
