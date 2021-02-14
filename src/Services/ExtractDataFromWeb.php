<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use League\Csv\Reader;
use League\Csv\Writer;

class ExtractDataFromWeb
{
 public function removeFromCsv($file, $from, $to, $path)
    {
        $data =  file_get_contents($file);
        $skuList = explode(PHP_EOL, $data);
        $newData = array_splice($skuList, $from, $to);
        $fp = fopen($path, 'w');

        foreach ($newData as $fields) {
            $item = explode(';', $fields);
            fputcsv($fp, $item);
            $fp = str_replace(",",";",$fp);
        }
        return $fp;
    }
    public function updateLeagueData(int $league, String $type, String $dir)
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:5000/' . $league . '/' . $type);
        $fp = fopen("C:/wamp64/www/AITranfert/public/csv/" . $dir . "/standars_data.csv", "r+");
        $line = fgets($fp);
        fwrite($fp, $response->getContent());
       
            fclose($fp);
    }

    public function updateData()
    {
        $directories = array('England', 'Spain', 'Germany', 'Italy', 'France', 'CL', 'EL');

        $files = array(
            'standars_data.csv', 'passing_data.csv', 'shooting_data.csv', 'timming_data.csv',
            'gk_data.csv', 'ad_gk_data.csv', 'miscellaneous_data.csv', 'pass_type_data.csv'
        );

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:5000/all', ['timeout' => 9000.5]);
        $data = $response->getContent();

        //  $data = array(
        //      "Ligue-1-Stats" => array("shooting" => 'yy', "passing" => 'uu'),
        //      "Champions-League-Stats" => array("timming" => 'yy', "standars" =>  'kk')
        //  );

        $current_charset = 'ISO-8859-15';
        $data = iconv('UTF-8//TRANSLIT', $current_charset, $data);
        $data = json_decode($data, JSON_UNESCAPED_UNICODE);
 
        foreach ($data as $index => $item) {
            echo $index . "\n";
            switch ($index) {
                case "Ligue-1-Stats":
                    $dir = "France";
                    break;
                case "Champions-League-Stats":
                    $dir = "CL";
                    break;
                case "Serie-A-Stats":
                    $dir = "Italy";
                    break;
                case "Europa-League-Stats":
                    $dir = "EL";
                    break;
                case "Bundesliga-Stats":
                    $dir = "Germany";
                    break;
                case "Premier-League-Stats":
                    $dir = "England";
                    break;
                case "La-Liga-Stats":
                    $dir = "Spain";
                    break;
            }
            foreach ($item as $fakeindex => $element) {
                switch ($fakeindex) {
                    case "standard":
                        $type = "standard";
                        echo $type;
                        break;
                    case "playing_time":
                        $type = "timming";
                        echo $type;
                        break;
                    case "keeper":
                        $type = "gk";
                        echo $type;
                        break;
                    case "keeper_adv":
                        $type = "ad_gk";
                        echo $type;
                        break;
                    case "shooting":
                        $type = "shooting";
                        echo $type;
                        break;
                    case "passing":
                        $type = "passing";
                        echo $type;
                        break;
                    case "misc":
                        $type = "miscellaneous";
                        echo $type;
                    case "passsing_types":
                        $type = "pass_type";
                        echo $type;
                        break;
                    case "defense":
                        $type = "defense";
                        echo $type;
                        case "possession":
                            $type = "possession";
                            echo $type;
                        break;
                    case "squad standard":
                        $type = "standard_team";
                        echo $type;
                        break;
                    case "squad playing_time":
                        $type = "timming_team";
                        echo $type;
                        break;
                    case "squad keeper":
                        $type = "gk_team";
                        echo $type;
                        break;
                    case "squad keeper_adv":
                        $type = "ad_gk_team";
                        echo $type;
                        break;
                    case "squad shooting":
                        $type = "shooting_team";
                        echo $type;
                        break;
                    case "squad passing":
                        $type = "passing_team";
                        echo $type;
                        break;
                    case "squad misc":
                        $type = "miscellaneous_team";
                        echo $type;
                        break;
                    case "squad passsing_types":
                        $type = "pass_type_team";
                        echo $type;
                        break;
                    case "squad defense":
                        $type = "defense_team";
                        echo $type;
                        break;
                        case "squad possession":
                            $type = "possession_team";
                            echo $type;
                            break;
                }
                // echo $element . "\n";
               // $this->removeFromCsv("C:/wamp64/www/AITranfert/public/csv/" . $dir . "/" . $type . "_data.csv", 0, 2000,"C:/wamp64/www/AITranfert/public/csv/" . $dir . "/" . $type . "_data.csv");
                $fp = fopen("C:/wamp64/www/AITranfert/public/csv/" . $dir . "/" . $type . "_data.csv", "r+");
                //$fp = fopen("C:/wamp64/www/AITranfert/public/England/shooting_data.csv", "r+");
                $line = fgets($fp);
                ftruncate($fp, 0);
                fclose($fp);

                $fp = fopen("C:/wamp64/www/AITranfert/public/csv/" . $dir . "/" . $type . "_data.csv", "r+");
                // $csv = $line . "\n" . $element;
                //echo $csv;
                
                $csv = utf8_encode($element);
                fwrite($fp, $line);
                fwrite($fp, $csv);
                //  fwrite($fp, $element . $fakeindex);
                fclose($fp);
            }
        }
        //return $data;
    }
}
