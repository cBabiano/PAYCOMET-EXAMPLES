<?php
include 'TEMPLATE/header.php';


// Se añade la clase
include("class/API_Rest.php");

// Se indica la API-KEY y terminal
$apiKey    = "d58bcc758623525ad0d90708101dfdad5541882b";
$paycomet = new Paycomet_Rest($apiKey);
$terminal = 38424;


?>
<form method="POST" action="" class="form-horizontal">
  <input type="hidden" name="action" value="1" />
  <div class="container padding-left:5px;">
    <div class="container">
      <div class="col-md-6 col-md-offset-3 column">
        <div class="form">
          <br />
          <div class="form-group">
            <div class="logo center"><img src="" /></div>
          </div>
          <div class="form-group">
            <label for="exampleInputName2" class="control-label">CANTIDAD A PAGAR</label>
            <div class="input-group">
              <input type="number" class="form-control" id="amount" required="required" name="amount" step="0.01" placeholder="Importe Máximo 250,00 Euros" min="1" max="250" pattern="[0-9]+([,\.][0-9]{0,2})?" />
              <span class="input-group-addon" id="sizing-addon2">€</span>
            </div>
          </div>
          <div class="form-group">
            <label for="method" class="control-label">REFERENCIA [Máximo 20 caracteres]</label>
            <input type="text" class="form-control" id="order" name="order" aria-label="" maxlength="20" />
          </div>
          <div class="form-group">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-secondary active">
                <input type="radio" name="method" id="card" value="1" checked> Tarjeta
              </label>
              <?php
              $paymentMethods = json_decode($paycomet->methods($terminal));

              // Si no hay error en la consulta a los metodos
              if (!isset($paymentMethods->errorCode)) {
                foreach ($paymentMethods as $apm) {
                  if ($apm->id != 1) {
                    echo "<label class=\"btn btn-secondary\"><input type=\"radio\" id=\"" . $apm->name . "\" name=\"method\" value=\"" . $apm->id . "\">" . $apm->name . "</label>";
                  }
                }
              }
              ?>
            </div>
          </div>
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

//parametros del form
$amount = number_format($_POST['amount'] * 100, 0, '.', '');
$methodId = $_POST['method'];

if ($methodId == 1) {
  // Se llama al método form y guardamos la respuesta en $response
  $response = $paycomet->form(
    1,
    'ES',
    $terminal,
    $_POST['order'],
    $amount,
    'EUR',
    1
  );
} else {

  // Ejecutamos el executePurchase
  $response = $paycomet->executePurchase(
    $terminal,
    $_POST['order'],
    $amount,
    'EUR',
    '127.0.0.1',
    $methodId, // method id
    null,
    null,
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
}


// Guardamos la challengeUrl
$URL = json_decode($response)->challengeUrl;

// Redirección con javascript
if ($URL != null) {
  echo '<script type="text/javascript">';
  echo 'window.location.href="' . $URL . '";';
  echo '</script>';
  
  echo '<noscript>';
  echo '<meta http-equiv="refresh" content="0;url=' . $URL . '" />';
  echo '</noscript>';

  die();
  
  }
?>

<?php
include 'TEMPLATE/footer.php';
?>