<?php
/**
 * PAYCOMET JET IFRAME callback
 * Tracking ID: SSX-7MS-JX3J
 *
 * @author PAYCOMET
 * @copyright Copyright (c) 2019, PAYCOMET
 * @version 1.1 2019-11-07
 */
 
// Se añade la clase
include("class/API_Rest.php");

// Se indica el jetID
$jetID = "2Ui0z7o84Gv3dmAhXabHRD1CngSpywex";

// Comprobamos que devuelve jetToken
if (isset($_POST["paytpvToken"])) {
    date_default_timezone_set("Europe/Madrid");

	// Guardamos el token
    $token = $_POST["paytpvToken"];

	// Verificamos que el token es correcto
    if ($token && strlen($token) == 64) {

		// Indicamos la API-KEY
		$apiKey		= "4946862062130a3737333942ee2daedaf04ff3d5";
		$paycomet= new Paycomet_Rest($apiKey);

		// propiedades
		$terminal = 9779;
		$amount = number_format($_POST['amount']*100,0, '.', '');

		
		// Ejecutamos el addUser y guardamos la respuesta
		$responseUser = $paycomet-> addUserTokenTmp($token, $terminal);

		// Guardamos el idUser y tokenUser
		$idUser = json_decode($responseUser)->idUser;
		$tokenUser = json_decode($responseUser)->tokenUser;
	
		// Ejecutamos el executePurchase
		$response = $paycomet-> executePurchase(
			$terminal,
			$_POST['order'],
			$amount,
			'EUR',
			'127.0.0.1',
			1, // method id
			$idUser,
			$tokenUser,
			1, // secure
			1, // user interaction
			null, // sca_exception
			null, // trx_type
			null, // productDescription
			null, // scoring
			"http://localhost/PAYCOMET-EXAMPLES/ok.php",
			"http://localhost/PAYCOMET-EXAMPLES/ko.php",
			null // merchant_data
		);
	
		// Verificamos si fallo
		if (json_decode($response)->errorCode != 0) {
			$URL = "/PAYCOMET-EXAMPLES/ko.php";
		} else {
			$URL = json_decode($response)->challengeUrl;
		}

		// Redirigimos con javascript
		if($URL != null){
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$URL.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$URL.'" />';
			echo '</noscript>'; 
		  
			die();
		  }
	}
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
				<aside class="col-sm-8">
					<p><h1></h1> </p>

					<article class="card">
						<div class="card-body">	
						<form role="form" id="paycometPaymentForm" method="POST">

							<hr>
							
							<input type="hidden" data-paycomet="jetID" value="<?php echo $jetID; ?>">

							<div class="form-group">
										<label for="exampleInputName2" class="control-label">CANTIDAD A PAGAR</label>
										<div class="input-group">
											<input type="number" class="form-control" id="amount" required="required" name="amount" step="0.01" placeholder="Importe Máximo 250,00 Euros" min="1" max="250" pattern="[0-9]+([,\.][0-9]{0,2})?"/>
											<span class="input-group-addon" id="sizing-addon2">€</span>
										</div>
										</div>
										<div class="form-group">
										<label for="exampleInputName2" class="control-label">REFERENCIA [Máximo 20 caracteres]</label>
										<input type="text" class="form-control" required="required" id="order" name="order"  aria-label="" maxlength="20"/>
										</div>
										<hr>
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
                                        <option value="24">2030</option>
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