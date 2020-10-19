
<?php

////Cargar Api Champions
$champions = @file_get_contents('http://ddragon.leagueoflegends.com/cdn/10.21.1/data/en_US/champion.json');
$championlive = json_decode($champions, true);


///daclarar variables
$summoner = '';
$region = '';
$regionc = '';
$apikey = 'RGAPI-2a113d6e-384e-4aec-8734-96cc9b5be525';


///funciones


class Apis
{
    public $apilink;
    public $apijson;
    public $apistado;
    public $respuestaapi;

    public function llamarapi()
    {
        $json = @file_get_contents($this->apilink);
        $this->apijson = json_decode($json, true);
        $this->apistado = $http_response_header[0];
        $this->respuestaapi = explode(" ", $this->apistado)[1];
    }
}



///Procesos
if (isset($_GET['summoner'])) {
    $summoner = $_GET['summoner'];
    // echo '<br>condicion 1<br/>';
    if (!$summoner == '') {
        $region = $_GET['region'];
        // echo '<br>' . $region . '<br/>';
        // echo '<br>' . $summoner . '<br>';
        if ($region == 'LAN') {
            $regionc = 'la1';
        } else {
            if ($region == 'LAS') {
                $regionc = 'la2';
            }
        }

        $url_1 = "https://" . $regionc . ".api.riotgames.com/lol/summoner/v4/summoners/by-name/" . $summoner . "?api_key=" . $apikey;

        $apicuentasummoner = new Apis;
        $apicuentasummoner->apilink = $url_1;
        $apicuentasummoner->llamarapi();
        echo $apicuentasummoner -> respuestaapi;


        switch ($apicuentasummoner -> respuestaapi) {
            case 404:
                echo 'no se encontro nada';
                goto fin;
                break;

            case 200:
                // echo 'todo okey';
                echo '<pre>' . print_r($apicuentasummoner -> apijson, true) . '</pre>';
                goto loadlive;
                break;

            default:
                echo 'Algo salio mal';
                die;
        }
    } else {
        echo 'Vacio';
        header('Location: http://localhost/APP%20ESPECTADOR%20RIOT');
        die;
    }
} else {
    fin:
    return;
}



loadlive:
$url_live = "https://la1.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/" . $apicuentasummoner -> apijson["id"] . "?api_key=" . $apikey;


$espectadorapi = new Apis;
$espectadorapi -> apilink = $url_live;
$espectadorapi -> llamarapi();



switch ($espectadorapi -> respuestaapi) {
    case 404:
        echo 'No live';
        goto fin;
        break;

    case 200:
        echo '<pre>' . print_r($espectadorapi -> apijson , true) . '</pre>';
        break;

    default:
        echo 'Algo salio mal 2';
        die;
}
