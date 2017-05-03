<?php
// import dom parser file 
include('simple_html_dom.php');

$html = file_get_html('http://www.ilboursa.com/marches/palmares.aspx');
       
$indice=0;
$obj = new stdClass();
$response=array();
$object=array("nom"=>"", "haut"=>0,"bas"=>0,"Dernier"=>0,"volume"=>0 ,"variation"=>0);

foreach($html->find('tr.alri') as $e){
    $index = 0;
    foreach($e->find('td') as $f){
        switch($index){
				case 0:
                    $g = $f->find('a');
                    $object['nom']=$g[0]->innertext;
				break;
				case 1:
					$object['haut']=$f->innertext;
				break;
				case 2:
					$object['bas']=$f->innertext;
				break;
				case 3:
					$g = $f->find('b');
                    $object['Dernier']=$g[0]->innertext;
				break;
                case 4:
					$object['volume']=$f->innertext;
				break;
				case 5:
					$object['variation']=$f->innertext;
					array_push($response,$object);
					$object=array("nom"=>"", "haut"=>0,"bas"=>0,"Dernier"=>0,"volume"=>0 ,"variation"=>0);
				break;
	        }
        $index++;   
    }
    $indice++;
    if($indice == 5){
        break;
    }
}
$obj->palmares=$response;
echo(json_encode($obj));
?>
