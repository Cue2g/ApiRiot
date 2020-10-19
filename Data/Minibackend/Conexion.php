
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
function get_contents($http)
{
    $json = @file_get_contents($http);
    global $Statusapi1;
    global $cuenta;
    $cuenta = json_decode($json, true);
    $Statusapi1 = $http_response_header[0];
}

function get_live($http)
{
    $json = @file_get_contents($http);
    global $Statusapi2;
    global $cuentalive;
    $cuentalive = json_decode($json, true);
    $Statusapi2 = $http_response_header[0];
}

function filtroEstatus($Variable)
{
    global $Stapi1;
    $Stapi1 = explode(" ", $Variable)[1];
}

Class Apis{
 public $apilink;
 public $liveapi;
 public $apistado;

 public function llamarapi(){
    $json = @file_get_contents($this->apilink);
    $this->liveapi = json_decode($json, true);
    $this->apistado = $http_response_header[0];
 }
}



$apicuenta = new Apis;

$apicuenta -> apilink = 'https://americas.api.riotgames.com/riot/account/v1/accounts/by-puuid/aAcgMhXO9BYRApk-lqCrdkFZWFrioa-1JSdX3gtMVVwibTk3-TUZQktar35Z3FQ6_AK2-RHs5bruEQ?api_key=RGAPI-2a113d6e-384e-4aec-8734-96cc9b5be525';


$apicuenta -> llamarapi();
var_dump($apicuenta -> liveapi);

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

        $url_1 = "https://" . $regionc . ".api.riotgames.com/lol/summoner/v4/summoners/by-name/" . $summoner . "?api_key=".$apikey;
        get_contents($url_1);
        // echo '<br>' . $Statusapi1 . '<br>';
        filtroEstatus($Statusapi1);
        // echo $Stapi1;

        switch ($Stapi1) {
            case 404:
                echo 'no se encontro nada';
                goto fin;
                break;

            case 200:
                // echo 'todo okey';
                echo '<pre>' . print_r($cuenta, true) . '</pre>';
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
$url_live = "https://la1.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/" . $cuenta["id"] . "?api_key=".$apikey;
get_live($url_live);
filtroEstatus($Statusapi2);


switch ($Stapi1) {
    case 404:
        echo 'No live';
        goto fin;
        break;

    case 200:
        echo '<pre>' . print_r($cuentalive, true) . '</pre>';
        break;

    default:
        echo 'Algo salio mal';
        die;
}
