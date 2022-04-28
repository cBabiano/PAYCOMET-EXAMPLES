<!DOCTYPE html>
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>PAYCOMET</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <script src="http://code.jquery.com/jquery.js"></script>
  <script type="text/javascript" src="bootstrap.min.js"></script>
  <form method="POST" action="" class="form-horizontal">
    <input type="hidden" name="action" value="1" />
    <div class="container padding-left:5px;">
      <div class="container">
        <div class="col-md-6 col-md-offset-3 column">
          <div class="form">
            <br/>
            <div class="form-group">
              <div class="logo center"><img src=""/></div>
            </div>
            <div class="form-group">
              <label for="exampleInputName2" class="control-label">CANTIDAD A PAGAR</label>
              <div class="input-group">
                <input type="number" class="form-control" id="amount" required="required" name="amount" step="0.01" placeholder="Importe Máximo 250,00 Euros" min="1" max="250" pattern="[0-9]+([,\.][0-9]{0,2})?"/>
                <span class="input-group-addon" id="sizing-addon2">€</span>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputName2" class="control-label">REFERENCIA [Máximo 20 caracteres]</label>
              <input type="text" class="form-control" id="order" name="order"  aria-label="" maxlength="20"/>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-large btn-block btn-primary">Continuar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  </body>
  </html>
<?php


$amount = number_format($_POST['amount']*100,0, '.', '');
$valores = array (
'operationType' => 1,
'language' => "es",
'terminal' =>  9779,
'order'=> $_POST['order'],
'amount' => $amount,
'currency' =>  "EUR",
'secure' =>  1,
'method' => $_POST['method'],
);
//payment es un objeto
$payment = new stdClass();
$payment->terminal = $valores['terminal'];//propiedades del objeto payments
$payment->order = $valores['order'];//propiedades del objeto payments
$payment->methods = array(); //propiedades del objeto payments si se queda en blanco monta todos los que tengas
//si defines (1) carga el que tengas https://docs.paycomet.com/es/recursos/metodos 
$payment->currency = $valores['currency'];//propiedades del objeto payments
$payment->secure = $valores['secure'];//propiedades del objeto payments
$payment->amount = $valores['amount'];//propiedades del objeto payments


$postFields = array(
"operationType" => $valores['operationType'],
"language" => $valores['language'],
"payment" => $payment,

);

//codifica el ARRAY en JSON
$jsonPostFields = json_encode($postFields);
//Inicia el CURL
$curl = curl_init();
// Valores de CURL
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rest.paycomet.com/v1/form',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 3,
  CURLOPT_POST => 1,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: 4946862062130a3737333942ee2daedaf04ff3d5',

  ),
));
//lanza la peticion
$response = curl_exec($curl);
//Decodifica el JSON y lo guarda en URL la CHALLENGE
$URL = json_decode($response)->challengeUrl;;
//Termina el CURL
curl_close($curl);
//Redirigir a la URL de challenge cambia la URL del navegador
header("Location: ".$URL);

?>



  