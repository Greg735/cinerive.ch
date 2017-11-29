<?php
    
    if (isset($_GET["site"])){
        $curSiteId = $_GET["site"];
    }
    else{
        $curSiteId = 1;
    }  
    if (isset($_GET["frm"])){
        $format = $_GET["frm"];
    }
    else{
        $format = 0;
    }
    if($format == 0){
        header('Content-Type: text/xml; charset=utf-8', true);    
    }
    
    $dolpineURL = "http://ticketonline.cinerive.com:11718/1.0/";
    $urlCompl= "?apikey=c1n3R1v3\$Rex&language=fr"; 
    //http://ticketonline.cinerive.com:11718/1.0/shows?apikey=c1n3R1v3$Rex&language=fr&siteid=100001
    $map_url = $dolpineURL . "shows" . $urlCompl;
    
    $sitearray = array(1=>array(100001=>'Rex',100002=>'Astor'), 2=>array(100003=>'Hollywood'), 3=>array(100004=>'Cosmopolis'),99=>array(100001=>'Rex',100002=>'Astor', 100003=>'Hollywood', 100004=>'Cosmopolis') );
    $limites= array(1=>5, 2=>2, 3=>3, 99=>10);
    //5 lignes pour l'Url Vevey, 2 lignes pour l'url Mtx et 3 lignes pour l'url Aigle
    
    //print_r($sitearray);    
    $dataArray = array(); 
    $dataHTMLArray= array();  
    //echo "TEST XML"; 

    foreach ($sitearray[$curSiteId] as $siteid =>$sitename ) {
        //echo "Site : " .  $siteid. "<br/>";
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("tomorrow"));
        $map_url_site = $map_url . "&siteid=" .  $siteid . "&from=" . $today. "&to=" . $tomorrow;
        //echo "map_url " . $map_url_site . "<br/>";
        $datas = getXMLdata($map_url_site);
        
        //echo count($datas);
        $falsecode = 9999900;
        if($datas==!false){
            foreach($datas->children() as $k=>$show){
                $datetime1 = new DateTime('-40 minutes',new DateTimeZone('Europe/Zurich'));
                $datetime2 = new DateTime($show->ShowTime,new DateTimeZone('Europe/Zurich'));
                //$test = $datetime1->format('Y-m-d H:i:s');
                //$test2 = $datetime2->format('Y-m-d H:i:s');
                $code = date("YmdHi", strtotime($show->ShowTime)) . transAuditoriumKey($show->AuditoriumShortName);                             
                if ($datetime1 < $datetime2){
                                                                       
                    $dataArray[$code] = array(
                            'tx_titre_lng' => substr($show->EventName, 0, 59),
                            'tx_titre_ori' => substr($show->EventName, 0, 59),
                            'tx_titre_ver' => substr($show->EventName, 0, 59),
                            'tx_salle'=> $show->AuditoriumName,
                            'tx_site'=> $sitename,
                            'tx_vers_abr'=> $show->LanguageVersion,
                            'date'=> date("d.m.Y", strtotime($show->ShowTime)),
                            'sean_dep'=> date("H:i", strtotime($show->ShowTime)),
                            'va_place'=> $show->Capacity,
                            'va_solde'=> ($show->TicketsAvailable==0 ? null : $show->TicketsAvailable),
                            'ur_complet'=>($show->TicketsAvailable==0 ? 'http://www.cinerive.com/sites/default/files/img_ecrans/complet_def.png' : null),
                            'showID'=>$show['ID'], 
                            //'code'=>$code,
                            );
                }
                if($format == 1){
                    //$code = date("YmdHi", strtotime($show->ShowTime)). transAuditoriumKey($show->AuditoriumShortName);                                                   
                    $dataHTMLArray[$code] = array(
                            'tx_titre_lng' => substr($show->EventName, 0, 59),
                            'tx_titre_ori' => substr($show->EventName, 0, 59),
                            'tx_titre_ver' => substr($show->EventName, 0, 59),
                            'tx_salle'=> $show->AuditoriumName,
                            'tx_site'=> $sitename,
                            'tx_vers_abr'=> $show->LanguageVersion,
                            'date'=> date("d.m.Y", strtotime($show->ShowTime)),
                            'sean_dep'=> date("H:i", strtotime($show->ShowTime)),
                            'va_place'=> $show->Capacity,
                            'va_solde'=> ($show->TicketsAvailable==0 ? null : $show->TicketsAvailable),
                            'ur_complet'=>($show->TicketsAvailable==0 ? 'http://www.cinerive.com/sites/default/files/img_ecrans/complet_def.png' : null),
                            'showID'=>$show['ID'], 
                            'control_code'=>$code, //. " " . $test ." ". $test2
                            'cacher'=>($datetime1 < $datetime2 ? "non" : "oui")
                            );
                }
            }
        }
        else{
            /*$dataArray[0]= array('tx_titre_lng' => 'Aucune séance',
                            'tx_titre_ori' => 'Aucune séance',
                            'tx_titre_ver' =>'Aucune séance',
                            'tx_salle'=> $sitename,
                            'tx_site'=> $sitename,
                            'tx_vers_abr'=> null,
                            'date'=> null,
                            'sean_dep'=> null,
                            'va_place'=> null,
                            'va_solde'=> null,
                            'ur_complet'=>null,
                            'showID'=>null, 
                            );*/
            $dataHTMLArray[0]= array('tx_titre_lng' => 'Aucune info - signaler à Cinerive!!',
                            'tx_titre_ori' => 'Aucune info - signaler à Cinerive!!',
                            'tx_titre_ver' =>'Aucune info - signaler à Cinerive!!',
                            'tx_salle'=> $sitename,
                            'tx_site'=> $sitename,
                            'tx_vers_abr'=> null,
                            'date'=> null,
                            'sean_dep'=> null,
                            'va_place'=> null,
                            'va_solde'=> null,
                            'ur_complet'=>null,
                            'showID'=>null, 
                            );                            
        }
        
    }
    
    ksort($dataArray);
    //$CtrlData = $dataArray;
    $dataArray = array_slice($dataArray, 0, $limites[$curSiteId]);
    
    if($format == 0){
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><tableau></tableau>');
        array_to_xml($dataArray,$xml_data);
        print $xml_data->asXML();
    }
    else{
        echo "<html>
                <head><title>Cinerive - Ecrans XML version html</title>";
        echo '<link rel="stylesheet" type="text/css" href="style.css" media="all" />';        
        echo "</head><body>";
        echo "<h3>Contrôle écrans Cinérive</h3>";
        arrayToTable($dataArray);
        echo "<h3>Toutes les séances d'aujourd'hui et demain (en gris celles passées)</h3>";
        ksort($dataHTMLArray);
        arrayToTable($dataHTMLArray);
        echo "</body></html>";
    }

function arrayToTable($datas){    
    echo "<table>";    
    echo "<tr><th>Num.</th>";
    foreach(reset($datas) as $header=>$val){
        echo "<th>" . $header . "</th>";
    }
    echo "</tr>";
    $i=1;
    foreach($datas as $key=>$row){
        echo "<tr class='cacher_" . (isset($row['cacher'])? $row['cacher'] : null) .  "'><td>" . $i . "</td>";
        $i++;
        foreach($row as $k=>$val){
            echo "<td>" . $val . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
    
}

function transAuditoriumKey($auditName){
        
    $letter = substr($auditName, 0, 1);    
    $num = ord($letter);
    $end= substr($auditName, 1, 1);
    if(!is_numeric(substr($auditName, 1, 1))){
        $end = 1;
    }
   
    return (strlen($num) ==1 ? "0" . $num : $num) . $end ;
    
}


function array_to_xml( $data, &$xml_data ) {

    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
            $key = 'seance'; // . $key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

function getXMLdata($map_url =null){
    $errorlist="";
     if (file_contents_exist($map_url)){
        if (($response_xml_data = file_get_contents($map_url))===false){
            return false;
        } 
        else {
           libxml_use_internal_errors(true);
           $datas = simplexml_load_string($response_xml_data);
           if (!$datas) {
               foreach(libxml_get_errors() as $error) {
                   
               }
            return false;   
           } else {
              return $datas;
              
           }
        }
     }
}

function getEventNames($eventID){
    $dolpineURL = "http://ticketonline.cinerive.com:11718/1.0/";
    $urlCompl= "?apikey=c1n3R1v3\$Rex&language=fr"; 
    //http://ticketonline.cinerive.com:11718/1.0/shows?apikey=c1n3R1v3$Rex&language=fr&siteid=100001
    $map_url = $dolpineURL . "events/" . $eventID . $urlCompl;
    
    $datas = getXMLdata($map_url);
        
    if($datas==!false){
        //$datas[0]->Movie->OriginalName
            
        
    }
}
function file_contents_exist($url, $response_code = 200)
{
    $headers = get_headers($url);

    if (substr($headers[0], 9, 3) == $response_code)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}
?>
