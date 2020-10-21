<?php


header('Content-Type: application/json');



switch($_GET['secc']) {

	case 'summoner':
		echo json_encode($apilive -> apijson);
		break;
	case 'live':
		echo json_encode($espectadorapi -> apijson );
		break;
	default:
		echo json_encode([
			'error' => 'Secc fail, Cue es bello'
		]);
		break;
}
?>