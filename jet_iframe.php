<?php
/**
 * PAYCOMET JET IFRAME callback
 * Tracking ID: SSX-7MS-JX3J
 *
 * @author PAYCOMET
 * @copyright Copyright (c) 2019, PAYCOMET
 * @version 1.1 2019-11-07
 */
 
$jetID 			= "2Ui0z7o84Gv3dmAhXabHRD1CngSpywex";
$merchantCode   = "sfj65qn8";
$terminal       = "9779";
$password       = "Vs0cFTtz8fuKQHm2j19h";

if (isset($_POST["paytpvToken"])) {
    date_default_timezone_set("Europe/Madrid");

    $token = $_POST["paytpvToken"];
	//Jet_Token
	//var_dump($token);
	//die();
	//Jet_Token
    if ($token && strlen($token) == 64) {

        $endPoint       			= "https://api.paycomet.com/gateway/xml-bankstore?wsdl";
        $productDescription         = "XML_BANKSTORE TEST productDescription";
        $owner                      = "XML_BANKSTORE TEST owner";

        $signature
            = hash("sha512",
                $merchantCode
                .$token
                .$jetID
                .$terminal
                .$password
        );


        $ip				= $_SERVER["REMOTE_ADDR"];

        try {
            $context = stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            ));

            $clientSOAP = new SoapClient($endPoint, array('stream_context' => $context));
            $addUserTokenResponse
                = $clientSOAP->add_user_token(
                    $merchantCode,
                    $terminal,
                    $token,
                    $jetID,
                    $signature,
                    $ip
				);					

			if ($addUserTokenResponse["DS_ERROR_ID"] == "0") {
				// OK
				//echo " Proceso correcto. Se ha obtenido el token";
//var_dump($addUserTokenResponse);


$idUser = $addUserTokenResponse['DS_IDUSER'];
$tokenUser = $addUserTokenResponse['DS_TOKEN_USER'];
$account = $merchantCode;
$terminalid = $terminal;
// $password = $password;
$operation = 109;
$language = "ES";
$URLOK = "https://www.paycomet.com/url-ko";
$URLKO = "https://www.paycomet.com/url-ok";
$reference = date('YmdHis');
/*var_dump($reference);//muestra el tipo de variable y su contenido,*/
$amount = 250;
$currency = "EUR";
$concept = "Prueba Compra";
$scoring = 50;
$hash = hash("sha512",$account.$idUser.$tokenUser.$terminalid.$operation.$secure.$reference.$amount.$currency.md5($password));

$sm ='MERCHANT_MERCHANTCODE='.$account.
'&MERCHANT_TERMINAL='.$terminalid.
'&OPERATION='.$operation.
'&LANGUAGE='.$language.
'&MERCHANT_MERCHANTSIGNATURE='.$hash.
'&MERCHANT_ORDER='.$reference.
'&MERCHANT_AMOUNT='.$amount.
'&MERCHANT_CURRENCY='.$currency.
'&MERCHANT_PRODUCTDESCRIPTION='.$concept.
'&MERCHANT_SCORING='.$scoring.
'&URLOK='.$URLOK.
'&URLKO='.$URLKO.
'&IDUSER='.$idUser.	
'&TOKEN_USER='.$tokenUser .
'&3DSECURE=1'.$secure;

echo '<iframe title="titulo" src="https://api.paycomet.com/gateway/ifr-bankstore?'.$sm.'" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" style="border: 0px solid #000000; padding: 0px; margin: 0px">
	</iframe>';


				//header("Location: https://localhost:8443/Demo/ok.php");
				//die();

				
				//var_dump($executePurchaseResponse);

			} else {
				//var_dump("Error al obtener el token");
				//var_dump($addUserTokenResponse["DS_ERROR_ID"]);
				//return false;
				header("Location: https://localhost:8888/Demo/ko.php");
				die();
			}
        } catch(SoapFault $e){
			//var_dump($e);
			header("Location: https://localhost:8888/Demo/ko.php");
				die();
        }
    } else {
		//var_dump("Error, no se ha obtenido token");
		header("Location: https://localhost:8888/Demo/ko.php");
				die();
        //return false;
    }
    return false;
}
include 'TEMPLATE/header.php';
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
</head>
<body style = "background-color:#EAEAEA">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	<div class="container">
			<div class="row">
				<aside class="col-sm-6">
					<p><h1></h1> </p>

					<article class="card">
						<div class="card-body p-5">								
							<hr>
							<form role="form" id="paycometPaymentForm" method="POST">
							<input type="hidden" name="amount" value="1234">
							<input type="hidden" data-paycomet="jetID" value="<?php echo $jetID; ?>">
							<div class="form-group">
							<label for="username">Titular de la tarjeta</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<input type="text" class="form-control" name="username" data-paycomet="cardHolderName" placeholder="Titular de la tarjeta" required="">
								</div> <!-- input-group.// -->
								</div> <!-- form-group.// -->
								
							
                        		<div class="form-group" style="width:67%">
								<label for="username">Numero de tarjeta</label>
                                <div class="input-group">
                                    <div id="paycomet-pan" style="padding:1px;" class="form-control"></div>
							        <input paycomet-style="width: 100%; color: #495057; height: 23px; font-size:16px; padding-left:7px; padding-top:6px; border:1px; border-color:red" paycomet-name="pan">
                                </div>
								<img src="IMG/payment.png" alt="payments">
                        </div>

							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label><span class="hidden-xs">Fecha de Expiración</span> </label>
										<div class="form-inline">
											<select class="form-control" style="width:45%" data-paycomet="dateMonth">
												<option>Mes</option>
												<option value="01">01 - Enero</option>
                                        <option value="02">02 - Febrero</option>
                                        <option value="03">03 - Marzo</option>
                                        <option value="04">04 - Abril</option>
                                        <option value="05">05 - Mayo</option>
                                        <option value="06">06 - Junio</option>
                                        <option value="07">07 - Julio</option>
                                        <option value="08">08 - Agosto</option>
                                        <option value="09">09 - Septiembre</option>
                                        <option value="10">10 - Octubre</option>
                                        <option value="11">11 - Noviembre</option>
                                        <option value="12">12 - Diciembre</option>
											</select>
											<span style="width:10%; text-align: center"> / </span>
											<select class="form-control" style="width:45%" data-paycomet="dateYear">
												<option>Año</option>
												<option value="19">2019</option>
                                        <option value="20">2020</option>
                                        <option value="21">2021</option>
                                        <option value="22">2022</option>
                                        <option value="23">2023</option>
                                        <option value="24">2024</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group">
										<label data-toggle="tooltip" title="" data-original-title="Los tres últimos dígitos de la parte trasera de la tarjeta">CVV 
										<i class="fa fa-question-circle"></i></label>
												<div id="paycomet-cvc2" style="padding:1px;" class="form-control"></div>
								    <input paycomet-name="cvc2" paycomet-style="border:0px; width: 100%; color: #495057; height: 31px; font-size:16px; padding-left:7px;" required="required" type="text">
                                </div> <!-- form-group.// -->
								</div>

							</div> <!-- row.// -->
							<hr>
							<button class="subscribe btn btn-primary btn-block" type="submit"> Confirmar </button>
						</form>
							<div id="paymentErrorMsg">

							</div>
						</div> <!-- card-body.// -->
					</article> <!-- card.// -->
				</aside>
			</div><!-- row.// -->
			
		</div>
</div>
		<script src="https://api.paycomet.com/gateway/paycomet.jetiframe.js?lang=es"></script>
</body>
<?php
    include 'TEMPLATE/footer.php';
?>

</html>