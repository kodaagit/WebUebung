<?php

// PHP file for basic class with main functions
class WorldDataParser {
    
    function parseCSV(string $path) {
        $arr = array_map('str_getcsv', file($path));
        $removed = array_shift($arr);
        
        // rename keys
        foreach ( $arr as $k=>$v )
        {
            $arr[$k]['id'] = $arr[$k][0];
            unset($arr[$k][0]);
            $arr[$k]['name'] = $arr[$k][1];
            unset($arr[$k][1]);
            $arr[$k]['birth'] = $arr[$k][2];
            unset($arr[$k][2]);
            $arr[$k]['cell'] = $arr[$k][3];
            unset($arr[$k][3]);
            $arr[$k]['children'] = $arr[$k][4];
            unset($arr[$k][4]);
            $arr[$k]['electricity'] = $arr[$k][5];
            unset($arr[$k][5]);
            $arr[$k]['gdp_per_capita'] = $arr[$k][6];
            unset($arr[$k][6]);
            $arr[$k]['gdp_per_capita_growth'] = $arr[$k][7];
            unset($arr[$k][7]);
            $arr[$k]['inflation'] = $arr[$k][8];
            unset($arr[$k][8]);
            $arr[$k]['internet'] = $arr[$k][9];
            unset($arr[$k][9]);
            $arr[$k]['life'] = $arr[$k][10];
            unset($arr[$k][10]);
            $arr[$k]['military'] = $arr[$k][11];
            unset($arr[$k][11]);
            $arr[$k]['gps_lat'] = $arr[$k][12];
            unset($arr[$k][12]);
            $arr[$k]['gps_long'] = $arr[$k][13];
            unset($arr[$k][13]);
        }
        return $arr;
    }

    function saveXML(array $data) {
        $xml = new SimpleXMLElement('<Countries/>');

        function array_to_xml($array, &$xml) {        
            foreach($array as $key => $value) {               
                if(is_array($value)) {            
                    if(is_numeric($key)){
                        $key = 'Country';
                    }
                    $subnode = $xml->addChild($key);
                    array_to_xml($value, $subnode);
                } else {
                    $xml->addChild($key, $value);
                }
            }        
        }

        array_to_xml($data, $xml);
        
        $file = "world_data.xml";
        $domxml = new DOMDocument('1.0');
        $domxml->preserveWhiteSpace = false;
        $domxml->formatOutput = true;
        $domxml->loadXML($xml->asXML());

        return $domxml->save($file);
    }

    function printXML(string $xmlpath, string $xsltpath) {
        $xmldata = simplexml_load_file($xmlpath) or die("Failed to load");
        return $xmldata->employee[0]->firstname;
    }
        
}
?>