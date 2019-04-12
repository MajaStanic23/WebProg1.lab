<?php


include("simple_html_dom.php");
include("DiplomskiRadovi.php");

$tekst_rada = '';

for ($i = 2; $i < 7; $i++) {

	//stvori se objekt
	$diplomski_rad = new DiplomskiRadovi();
	
	
    $result = file_get_html("http://stup.etfos.hr/index.php/zavrsni-radovi/page/$i/", false, null, 0);

    foreach ($result->find('radovi') as $radovi) {
	
        $oib_tvrtke = $radovi->find('img')[0]->{'attr'}['src'];
        $oib_tvrtke = substr($oib_tvrtke, -15, 11);
        $link_rada = $radovi->find('a')[0]->{'attr'}['href'];
        $naziv_rada = $radovi->find('a')[0]->innertext;
        $link_endpoint = file_get_html("$link_rada", false, null, 0);
		
		if(!empty($link_endpoint)) {
			$full_content = $link_endpoint->find('div.post-content');

			foreach ($full_content as $paragraph) {
				$tekst_rada .= $paragraph;
			}
		}
	//spreme se vrijednosti u polje, tj. tu se dodaju vrijednosti objektu koje su parsirane iz stranice s ovim naredbama gore
        $data = array('naziv_rada'=>$naziv_rada, 'tekst_rada'=>$tekst_rada, 'link_rada'=>$link_rada, 'oib_tvrtke'=>$oib_tvrtke);

	//poziv funkcija 
        // $diplomski_rad->create($data);
	// $diplomski_rad->save($data);
       $diplomski_rad->read();
    }
}
?>