<?php
// import dom parser file 
include('simple_html_dom.php');

$html = file_get_html('http://www.ilboursa.com/marches/aaz.aspx');
       
$indice=0;
$obj = new stdClass();
$response=array();
$object=array("nom"=>"","ouverture"=>0, "haut"=>0,"bas"=>0,"titres"=>0,"volumeDT"=>0,"Dernier"=>0,"variation"=>0);
$tab = $html->find('tbody.alri');
foreach($html->find('tr') as $e){
    $index = 0;
    foreach($e->find('td') as $f){
        switch($index){
				case 0:
                    $g = $f->find('a');
                    $object['nom']=$g[0]->innertext;
				break;
                case 1:
					$object['ouverture']=$f->innertext;
				break;
				case 2:
					$object['haut']=$f->innertext;
				break;
				case 3:
					$object['bas']=$f->innertext;
				break;
                case 4:
					$object['titres']=$f->innertext;
				break;
                case 5:
					$object['volumeDT']=$f->innertext;
				break;
				case 6:
					$g = $f->find('b');
                    $object['Dernier']=$g[0]->innertext;
				break;
				case 7:
                    $g = $f->find('span');
                    $object['variation']=$g[0]->innertext;
					array_push($response,$object);
					$object=array("nom"=>"","ouverture"=>0, "haut"=>0,"bas"=>0,"titres"=>0,"volumeDT"=>0,"Dernier"=>0,"variation"=>0);
				break;
	        }
        $index++;   
    }
    $indice++;
    // if($indice == 5){
    //     break;
    // }
}
$obj->indices=$response;
echo(json_encode($obj));
?>
