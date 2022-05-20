<?php
class Paycomet_Rest
{
    private $API_KEY=" ";

    public function __construct($arg1)
	{
		$this->$API_KEY = $arg1;
	
	}

    public function methods($terminal)
	{
            
        $postFields = array(
        "terminal" => $terminal
        );
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/methods',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
	}

     /**
	* Añade una tarjeta a PAYCOMET. ¡¡¡ IMPORTANTE !!! Esta entrada directa debe ser activada por PAYCOMET.
	* @param int $operationtype Tipo de operación PAYCOMET (ID 1 - autorización, 3 - preautorización, 9 - suscripción, 107 - tokenización, 114 - autorización por referencia, 116 - autorización dcc).
	* @param string $lenguage Idioma para la interfaz de usuario.
    * @param string $amount Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
    * @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $currency Moneda de la transacción.
    * @param string $secure 0 o 1. Indica si la transacción es segura.
	* @return object respuesta de la operación


	*/
public function form($operationtype, $lenguage, $terminal,$order,$amount,$currency,$secure)
	{
        $valores = array (
            'operationType' => $operationtype
            );
        $payment = new stdClass();
        $payment->terminal = $terminal;
        $payment->order = $order;
        $payment->currency = $currency;
        $payment->secure = $secure;
        $payment->amount = $amount;
        $payment->methods = [$operationtype];
            
        $postFields = array(
        "operationType" => $valores['operationType'],
        "language" => $lenguage,
        "payment" => $payment
        );
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/form',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
	}
    /**
	* Añade una tarjeta a PAYCOMET. ¡¡¡ IMPORTANTE !!! Esta entrada directa debe ser activada por PAYCOMET.
	* @param int $pan Número de tarjeta, sin espacios ni guiones
	* @param string $expiryyear Año de caducidad de la tarjeta
    * @param string $expirymonth Mes de caducidad de la tarjeta
    * @param string $cvc2 Código CVC2 de la tarjeta
    * @param int $terminal ID de producto o terminal.
	* @param string $order La referencia se incluirá en la devolución de llamada.
    * @param string $cardholdername Nombre del titular de la tarjeta
    * @param string $productdescription Concepto, se incluirá en la devolución de llamada.
	* @return object respuesta de la operación


	*/

    public function addUser($terminal, $cvc2, $expiryyear,$expirymonth,$pan,$order,$lenguage,$cardholdername,$productdescription)
	{
       
        $postFields = array(
        "terminal" => $terminal,
        "order" => $order,
        "pan" => $pan,
        "expiryMonth" => $expirymonth,
        "expiryYear" => $expiryyear,
        "cvc2" => $cvc2,
        "procducDescription" => $productdescription,
        "lenguage" => $lenguage,
        );
        $jsonPostFields = json_encode($postFields);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.paycomet.com/v1/cards',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}   

    public function editUser($terminal, $cvc2, $expiryyear,$expirymonth,$idUser,$tokenUser)
	{
       
        $postFields = array(
        "terminal" => $terminal,
        "expiryMonth" => $expirymonth,
        "expiryYear" => $expiryyear,
        "cvc2" => $cvc2,
        "idUser" => $idUser,
        "tokenUser" => $tokenUser,
        );
        $jsonPostFields = json_encode($postFields);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.paycomet.com/v1/cards/edit',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}  
    
      /**
	* Añade una tarjeta a PAYCOMET. ¡¡¡ IMPORTANTE !!! Usando jetIframe.
	* En su defecto el método de entrada de tarjeta para el cumplimiento del PCI-DSS debe ser AddUser
    * @param int $termianl Id del producto 
	* @param string $jettoken Tokentemp que devuelve el jetIframe
	* @return object respuesta de la operación


	*/
    public function addUserTokenTmp($jetToeken, $terminal)
	{
        

        $postFields = array(
        "terminal" => $terminal,
        "jetToken" => $jetToeken, 
        );
        $jsonPostFields = json_encode($postFields);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.paycomet.com/v1/cards',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
	}  
 /**
	* Informa de los datos de tarjeta del cliente
	* @param int $termianl Id del producto
    * @param int $iduser Id de usuario en PAYCOMET
	* @param string $tokenuser Token de usuario en PAYCOMET
	* @return object respuesta de la operación
	
	*/
    public function infoUser($terminal,$iduser,$tokeuser)
	{
     

        $postFields = array(
        "terminal" => $terminal,
        "iduser" => $iduser, 
        "tokenuser" => $tokeuser 
        );
        $jsonPostFields = json_encode($postFields);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.paycomet.com/v1/cards/info',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
	}  

    /**
	* Elimina un usuario de PAYCOMET
	* @param int $termianl Id del producto
    * @param int $iduser Id de usuario en PAYCOMET
	* @param string $tokenuser Token de usuario en PAYCOMET
	* @return object respuesta de la operación

	
	*/
    public function removeUser($terminal,$iduser,$tokeuser)
	{
      
        $postFields = array(
        "terminal" => $terminal,
        "iduser" => $iduser, 
        "tokenuser" => $tokeuser
        );
        $jsonPostFields = json_encode($postFields);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.paycomet.com/v1/cards/delete',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
	}  
/**
	* Ejecuta un pago 
    * @param int $termianl Id del producto
	* @param int $iduser Id del usuario en PAYCOMET
	* @param string $tokneuser Token del usuario en PAYCOMET
	* @param string $amount Importe del pago 1€ = 100
	* @param string $currency Identificador de la moneda de la operación
	* @param string $productdescription Descripción del producto
	* @param integer $scoring (optional) Valor de scoring de riesgo de la transacción
	* @param string $merchant_data (optional) Datos del Comercio
	* @param string $merchant_description (optional) Descriptor del Comercio
	* @param string $sca_exception (optional) Opcional TIPO DE EXCEPCIÓN AL PAGO SEGURO.
	* @param string $trx_type (condicional) Obligatorio sólo si se ha elegido una excepción MIT en el campo MERCHANT_SCA_EXCEPTION. 
	* @param string $scrow_targets (optional) Identificación de los destinatarios de ingresos en operaciones ESCROW
	* @param string $user_interaction (optional) Indicador de si es posible la interacción con el usuario por parte del comercio
	* @return object respuesta de la operación

*/

public function executePurchase($terminal,$order,$amount,$currency,$originalip,$methodid,$iduser,$tokenuser,$secure,$userinteraction=null,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null, $urlOk = null, $urlKo = null, $merchant_data = null)
	{
       
      
        $payment = new stdClass();
        $payment->terminal = $terminal;
        $payment->order = $order;
        $payment->amount = $amount;
        $payment->currency = $currency;
        $payment->originalIp = $originalip;
        $payment->secure = $secure;
        $payment->idUser = $iduser;
        $payment->tokenUser = $tokenuser;
        $payment->methodId = $methodid;
        if ($userinteraction){
			$payment->userInteraction = $userinteraction;
		}
        if ($sca_exception){
			$payment->scaException = $sca_exception;
		}
		if ($trx_type){
			$payment->trxType = $trx_type;
		}
        if ($productDescription){
			$payment->productDescription = $productDescription;
		}
        
		if ($scoring) {
			$payment->scoring = (int)$scoring;
		}

		if ($urlOk) {
			$payment->UrlOk = $urlOk;
		}

		if ($urlKo) {
			$payment->UrlKo = $urlKo;
		}

		if ($merchant_data){
			$payment->merchantData = $merchant_data;
		}

		
            
        
        $postFields = array( "payment" => $payment);
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments',
        CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}
    /**
	* Ejecuta la devolución de un pago 
    * @param int $terminal ID de producto o terminal.
	* @param string $amount Importe a devolver en formato numérico. Si está vacío, se asume el reembolso total.
	* @param string $currency Moneda de la transacción
	* @param string $authCode Código bancario original de la autorización de la transacción.
	* @param string $originalIp Dirección IP de la aplicación del negocio.
	* @param string $tokenUser Código de token asociado con el IdUser.
	* @param int $idUser Identificador único del usuario registrado en el sistema.
	* @param int $notifyDirectPayment (opcional) Configure la notificación POST del resultado de la operación (valores posibles: 1 - forzar notificación, 2 - no notificar). Avisará si no se informa
	* @return object respuesta de la operación

*/
    public function executeRefund($order,$terminal, $amount,$currency,$originalip,$authCode, $iduser,$tokenuser,$notifyPayment=null )
	{
        

        $payment = new stdClass();
        $payment->terminal = $terminal;
        $payment->amount = $amount; 
        $payment->currency = $currency;
        $payment->originalIp = $originalip;
        $payment->authCode = $authCode;
        $payment->idUser = $iduser;
        $payment->tokenUser = $tokenuser;
        if ($notifyDirectPayment){
			$payment->notifyDirectPayment = $notifyDirectPayment;
		}
        
        $postFields = array(
        "payment" => $payment,
        
        );
        
        
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'.$order.'/refund',
        CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}
 /**
	* Crea un pago DCC
	* @param int $terminal ID de producto o terminal.
	* @param string $currency Moneda de la transacción.
	* @param string $order  Referencia única para la compra del comerciante
    * @param string $amount Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
    * @param string $idUser Tarjeta de identificación de usuario otorgada por PAYCOMET. Obligatorio si es pago con tarjeta.
    * @param string $tokenUser Tarjeta de identificación de usuario otorgada por PAYCOMET. Obligatorio si es pago con tarjeta.
    * @param string $userinteraction (Opcional) Indica si la empresa puede interactuar con el cliente.
	* @param string $originalIp  Dirección IP del cliente que inició la transacción de pago
    * @param string $scoring (Opcional)Valor de puntuación de riesgo de 0 a 100.
    * @param string $sca_exception (Opcional) TIPO DE EXCEPCIÓN AL PAGO SEGURO. Si no se especifica, PAYCOMET intentará asignarle la más adecuada posible
	* @param string $trx_type Fecha (Opcional) Obligatorio solo si se ha seleccionado una excepción MIT en scaException
	* @param string $productDescription (Opcional) DEscripción del producto vendido
	* @return object (Opcional)Objeto Información de autenticación del cliente. Cuanta más información se proporcione en este campo, más probable será la autorización de la operación sin requerir autenticación adicional. Por esta razón, se recomienda enviar la mayor cantidad de información posible.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
    public function dccPurchaseCreate($amount,$order,$idUser,$tokenUser,$originalIp,$terminal,$userinteraction=null,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null, $urlOk = null, $urlKo = null, $merchant_data = null )
	{
       
        $payment = new stdClass();
        $payment->amount = $amount;
        $payment->order = $order;
        $payment->idUser = $idUser;
        $payment->tokenUser = $tokenUser;
        $payment->originalIp = $originalIp;
        if ($userinteraction){
			$payment->userInteraction = $userinteraction;
		}
        if ($sca_exception){
			$payment->scaException = $sca_exception;
		}
		if ($trx_type){
			$payment->trxType = $trx_type;
		}
        if ($productDescription){
			$payment->productDescription = $productDescription;
		}
        
		if ($scoring) {
			$payment->scoring = (int)$scoring;
		}

		if ($urlOk) {
			$payment->UrlOk = $urlOk;
		}

		if ($urlKo) {
			$payment->UrlKo = $urlKo;
		}

		if ($merchant_data){
			$payment->merchantData = $merchant_data;
		}

            
        
        $postFields = array( "payment" => $payment);
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/dcc',
        CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}

    /**
	* Confirma pago anterior de DCC
	* @param int $terminal ID de producto o terminal.
	* @param string $currency Moneda de la transacción.
	* @param string $session.
	* @param string $order (Opcional) Referencia única para la compra del comerciante
    * @param string $amount (Opcional) Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
    * @param string $idUser (Opcional) Tarjeta de identificación de usuario otorgada por PAYCOMET. Obligatorio si es pago con tarjeta.
    * @param string $tokenUser (Opcional) Tarjeta de identificación de usuario otorgada por PAYCOMET. Obligatorio si es pago con tarjeta.
    * @param string $userinteraction (Opcional) Indica si la empresa puede interactuar con el cliente.
	* @param string $originalIp (Opcional) Dirección IP del cliente que inició la transacción de pago
    * @param int $secure(Opcional) 0 o 1. Indica si la transacción es segura.
    * @param string $scoring (Opcional)Valor de puntuación de riesgo de 0 a 100.
    * @param string $sca_exception (Opcional) TIPO DE EXCEPCIÓN AL PAGO SEGURO. Si no se especifica, PAYCOMET intentará asignarle la más adecuada posible
	* @param string $trx_type Fecha (Opcional) Obligatorio solo si se ha seleccionado una excepción MIT en scaException
	* @param string $productDescription (Opcional) DEscripción del producto vendido
	* @return object (Opcional)Objeto Información de autenticación del cliente. Cuanta más información se proporcione en este campo, más probable será la autorización de la operación sin requerir autenticación adicional. Por esta razón, se recomienda enviar la mayor cantidad de información posible.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
    public function dccPurchaseConfirm($terminal,$currency,$session,$amount=null,$order=null,$idUser=null,$tokenUser=null,$originalIp=null,$secure=null,$userinteraction=null,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null, $urlOk = null, $urlKo = null, $merchant_data = null )
	{
       
        $payment = new stdClass();
        $payment->terminal = $terminal;
        if ($secure){
			$payment->amount = $amount;
		}
        if ($idUser){
			$payment->idUser = $idUser;
		}
        if ($tokenUser){
			$payment->tokenUser = $tokenUser;
		}
        if ($originalIp){
			$payment->originalIp = $originalIp;
		}
      
        if ($secure){
			$payment->secure = $secure;
		}
        if ($userinteraction){
			$payment->userInteraction = $userinteraction;
		}
        if ($sca_exception){
			$payment->scaException = $sca_exception;
		}
		if ($trx_type){
			$payment->trxType = $trx_type;
		}
        if ($productDescription){
			$payment->productDescription = $productDescription;
		}
        
		if ($scoring) {
			$payment->scoring = (int)$scoring;
		}

		if ($urlOk) {
			$payment->UrlOk = $urlOk;
		}

		if ($urlKo) {
			$payment->UrlKo = $urlKo;
		}

		if ($merchant_data){
			$payment->merchantData = $merchant_data;
		}



        $dcc = new stdClass();
        $dcc->currency = $currency;
        $dcc->session = $session;
        
        $postFields = array( "payment" => $payment,"dcc" => $dcc);
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'.$order.'/dcc/confirm',
        CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}

    /**
	* Busca una operacion
	* @param int $terminal ID de producto o terminal.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
    public function operationInfo($terminal,$order){

        $payment = new stdClass();
        $payment->terminal = $terminal;
        
    
        $postFields = array(
        "payment" => $payment
        
        );
        
        $jsonPostFields = json_encode($postFields);
    
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'.$order.'/info',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $jsonPostFields,
          CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Connection: Keep-Alive',
              'PAYCOMET-API-TOKEN: '.$this->$API_KEY
    
      ),
      ));
            $response = curl_exec($curl);
    
            curl_close($curl);
            return $response;
    
    }

/**
	* Busca una operaicon
	* @param int $terminal ID de producto o terminal.
	* @param string $currency Moneda de la transacción.
    * @param string $fromDate Límite de fecha y hora de inicio (formato: YmdHis)
	* @param string $toDate Límite de fecha y hora de finalización (formato: YmdHis)
    * @param int $maxAmount Importe máximo de la operación en formato entero
	* @param string $minAmount Importe mínimo de la operación en formato entero
    * @param array $operations Tipos de operación PAYCOMET (1 - Autorización, 3 - Preautorización, etc...)
	* @param string $sortOrder Ordenar resultados ASC = Ascendente, DESC = Descendente.
    * @param string $sortType Tipo de clasificación (0 Sin clasificación, 1 fecha, 2 orden, 3 tipo, 4 estado, 5 terminal, 6 cantidad, 7 usuario).
    * @param string $state Resultado de la operación. 0 es operación fallida, 1 operación correcta y 2 operación inconclusa (para operaciones pendientes desde un SCA o 3DS).
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/

    public function operationSearch( $currency, $fromDate,$toDate,$maxAmount,$minAmount,$operations,$sortOrder,$sortType,$state,$terminal)
	{
       
        $postFields = array(
        "terminal" => $terminal,
        "currency" => $currency,
        "fromDate" => $fromDate,
        "toDate" => $toDate,
        "minAmount" => $minAmount,
        "maxAmount" => $maxAmount,
        "operations" => $operations,
        "sortOrder" => $sortOrder,
        "sortType" => $sortType,
        "state" => $state
        );
        $jsonPostFields = json_encode($postFields);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/search',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	} 


    /**
    * Obtiene el saldo de un producto. 
	* @param int $termianl Id del producto
	* @return object respuesta de la operación
    */
    public function balance($terminal){

    $postFields = array( "terminal" => $terminal,);
    $jsonPostFields = json_encode($postFields);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/balance',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }    

/**
	* Crea una preautorización
	* @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $amount Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
	* @param string $currency Moneda de la transacción.
    * @param string $methodId ID del método de pago PAYCOMET. 1 es para tarjeta.
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
    * @param int $secure 0 o 1. Indica si la transacción es segura.
	* @param string $urlOk Url donde el cliente será redirigido después de finalizar una transacción correcta. (255 caracteres como máximo)
    * @param string $urlKo Url donde el cliente será redirigido después de finalizar una transacción fallida. (255 caracteres como máximo)
	* @param string $userinteraction Indica si la empresa puede interactuar con el cliente.
    * @param string $scoring (Opcional)Valor de puntuación de riesgo de 0 a 100.
    * @param string $sca_exception (Opcional) TIPO DE EXCEPCIÓN AL PAGO SEGURO. Si no se especifica, PAYCOMET intentará asignarle la más adecuada posible
	* @param string $trx_type Fecha (Opcional) Obligatorio solo si se ha seleccionado una excepción MIT en scaException
	* @param string $productDescription (Opcional) DEscripción del producto vendido
	* @return object $merchant_data (Opcional)Objeto Información de autenticación del cliente. Cuanta más información se proporcione en este campo, más probable será la autorización de la operación sin requerir autenticación adicional. Por esta razón, se recomienda enviar la mayor cantidad de información posible.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
  public function preauth($terminal,$order,$amount,$currency,$originalip,$methodid,$iduser,$tokenuser,$secure,$userinteraction=null,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null, $urlOk = null, $urlKo = null, $merchant_data = null){

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->order = $order;
    $payment->amount = $amount; 
    $payment->currency = $currency;
    $payment->originalIp = $originalip;
    $payment->methodId = $methodid;
    $payment->idUser = $iduser;
    $payment->tokenUser = $tokenuser;
    $payment->secure = $secure;
    if ($userinteraction){
        $payment->userInteraction = $userinteraction;
    }
    if ($sca_exception){
        $payment->scaException = $sca_exception;
    }
    if ($trx_type){
        $payment->trxType = $trx_type;
    }
    if ($productDescription){
        $payment->productDescription = $productDescription;
    }
    
    if ($scoring) {
        $payment->scoring = (int)$scoring;
    }

    if ($urlOk) {
        $payment->UrlOk = $urlOk;
    }

    if ($urlKo) {
        $payment->UrlKo = $urlKo;
    }

    if ($merchant_data){
        $payment->merchantData = $merchant_data;
    }
    if ($deferred){
        $payment->deferred = $deferred;
    }
    




    $postFields = array(
    "payment" => $payment,
    
    );
    
    $jsonPostFields = json_encode($postFields);

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/preauth',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $jsonPostFields,
      CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Connection: Keep-Alive',
          'PAYCOMET-API-TOKEN: '.$this->$API_KEY

  ),
  ));
        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

}

/**
	* Cancela una preautorización 
	* @param int $termianl ID de producto o terminal.
	* @param string $amount importe a confirmar
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
	* @param string $authCode Código bancario de autorización de la operación (requerido para realizar una devolución).
	* @param int $deferred (Opcional) Identificar la preautorización como diferida
    * @param int $notifyDirectPayment (Opcional) Configurate POST notification of the operation result (possible values: 1 - force notify, 2 - not notify). It will notify if is not informed
	* @return object respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function preauth_cancel($order,$terminal,$amount,$originalip,$authcode,$deferred=null,$notifyDirectPayment=null){

   

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->amount = $amount; 
    $payment->originalIp = $originalip;
    $payment->authCode = $authcode;
    if ($deferred){
        $payment->deferred = $deferred;
    }
    if ($notifyDirectPayment){
        $payment->notifyDirectPayment = $notifyDirectPayment;
    }
    



    $postFields = array(
    "payment" => $payment,
    
    );

        $jsonPostFields = json_encode($postFields);
        $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'.$order.'/preauth/cancel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
      
}
/**
	* Confirma una preautorización 
	* @param int $termianl ID de producto o terminal.
	* @param string $amount importe a confirmar
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
	* @param string $authCode Código bancario de autorización de la operación (requerido para realizar una devolución).
	* @param int $deferred (Opcional) Identificar la preautorización como diferida
    * @param int $notifyDirectPayment (Opcional) Configurate POST notification of the operation result (possible values: 1 - force notify, 2 - not notify). It will notify if is not informed
	* @return object respuesta de la operación
	* @version 2.0 03/05/2022

	*/
public function preauth_confirm($order,$terminal,$amount,$originalip,$authcode,$deferred=null,$notifyDirectPayment=null){
    

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->amount = $amount; 
    $payment->originalIp = $originalip;
    $payment->authCode = $authcode;
    if ($deferred){
        $payment->deferred = $deferred;
    }
    if ($notifyDirectPayment){
        $payment->notifyDirectPayment = $notifyDirectPayment;
    }
    



    $postFields = array(
    "payment" => $payment,
    
    );

        $jsonPostFields = json_encode($postFields);
        $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'.$order.'/preauth/confirm',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
}
/**
	* Crea una suscripción en PAYCOMET sobre una tarjeta. 
    * @param int $termianl Id del producto
	* @param int $iduser Id del usuario en PAYCOMET
    * @param string $tokenuser Token del usuario en PAYCOMET
	* @param string $startdate Fecha de inicio de la suscripción yyyy-mm-dd
	* @param string $enddate Fecha de fin de la suscripción yyyy-mm-dd
	* @param string $transreference Identificador único del pago
	* @param string $periodicity Periodicidad de la suscripción. Expresado en días.
	* @param string $amount Importe del pago 1€ = 100
	* @param string $currency Identificador de la moneda de la operación
	* @param string $ownerName (optional) Titular de la tarjeta
	* @param integer $scoring (optional) Valor de scoring de riesgo de la transacción
	* @param string $merchant_data (optional) Datos del Comercio
	* @param string $sca_exception (optional) Opcional TIPO DE EXCEPCIÓN AL PAGO SEGURO.
	* @param string $trx_type (condicional) Obligatorio sólo si se ha elegido una excepción MIT en el campo MERCHANT_SCA_EXCEPTION. 
	* @param string $scrow_targets (optional) Identificación de los destinatarios de ingresos en operaciones ESCROW
	* @param string $user_interaction (optional) Indicador de si es posible la interacción con el usuario por parte del comercio	
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function suscription($starDate,$endDate,$periodicity,$terminal,$methodId,$amount,$currency,$idUser,$tokenUser,$order,$originalIp,$secure,$userinteraction=null,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null, $urlOk = null, $urlKo = null, $merchant_data = null){
   
    $subscription = new stdClass();
    $subscription->startDate = $starDate;
    $subscription->endDate = $endDate;
    $subscription->periodicity = $periodicity;

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->methodId = $methodId;
    $payment->order = $order;; 
    $payment->amount = $amount;
    $payment->currency = $currency;
    $payment->originalIp = $originalIp;
    $payment->idUser = $idUser;
    $payment->tokenUser = $tokenUser;
    $payment->secure = $secure;
    if ($userinteraction){
        $payment->userInteraction = $userinteraction;
    }
    if ($sca_exception){
        $payment->scaException = $sca_exception;
    }
    if ($trx_type){
        $payment->trxType = $trx_type;
    }
    if ($productDescription){
        $payment->productDescription = $productDescription;
    }
    
    if ($scoring) {
        $payment->scoring = (int)$scoring;
    }

    if ($urlOk) {
        $payment->UrlOk = $urlOk;
    }

    if ($urlKo) {
        $payment->UrlKo = $urlKo;
    }

    if ($merchant_data){
        $payment->merchantData = $merchant_data;
    }

    $postFields = array( "subscription"=> $subscription, "payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}
/**
	* Modifica una suscripción en PAYCOMET sobre una tarjeta.
    * @param int $termianl ID de producto o terminal.
	* @param int $iduser Tarjeta de identificación de usuario otorgada por PAYCOMET. Obligatorio si es pago con tarjeta.
	* @param string $tokenuser Tarjeta de identificación de usuario otorgada por PAYCOMET. Obligatorio si es pago con tarjeta.
	* @param string $startdate Fecha de inicio de la suscripción yyyy-mm-dd
	* @param string $enddate Fecha de fin de la suscripción yyyy-mm-dd
	* @param string $periodicity Periodicidad de la suscripción. Expresado en días.
	* @param string $amount Importe del pago 1€ = 100
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/

public function suscriptionEdit($order,$startDate,$endDate,$periodicity,$terminal,$amount,$originalIp,$idUser,$tokenUser){
    
    $subscription = new stdClass();
    $subscription->startDate = $startDate;
    $subscription->endDate = $endDate;
    $subscription->periodicity = $periodicity;

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->amount = $amount;
    $payment->originalIp = $originalIp;
    $payment->idUser = $idUser;
    $payment->tokenUser = $tokenUser;

    $postFields = array( "subscription"=> $subscription, "payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription/'.$order.'/edit',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}

/**
	* Elimina una suscripción en PAYCOMET sobre una tarjeta.
    * @param string $order referencia de suscripcion a eliminar
    * @param string $methodId PAYCOMET payment method ID. 1 is for card.
    * @param int $terminal Id del producto
	* @param int $iduser Identificador único del usuario registrado en el sistema.
	* @param string $tokenuser Código token asociado al IDUSER.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function suscriptionRemove($order,$terminal,$methodId,$idUser,$tokenUser){
   
    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->methodId = $methodId;
    $payment->order = $order;
    $payment->idUser = $idUser;
    $payment->tokenUser = $tokenUser;

    $postFields = array("payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription/'.$order.'/remove',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

} 

/**
	* Informa sobre una suscripción en PAYCOMET sobre una tarjeta.
    * @param string $order
    * @param string PAYCOMET payment method ID. 1 is for card.
    * @param int $termianl Id del producto
	* @param string $iduser Identificador único del usuario registrado en el sistema.
	* @param string $tokenuser Código token asociado al IDUSER.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/

public function suscriptionInfo($order,$terminal,$methodId,$idUser,$tokenUser){
   
    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->methodId = $methodId;
    $payment->idUser = $idUser;
    $payment->tokenUser = $tokenUser;

    $postFields = array("payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription/'.$order.'/info',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

} 

/**
	* Cancela un pedido SEPA
	* @param int $terminal ID de producto o terminal.
	* @param int $sepaProviderId Identificador único asignado por PAYCOMET para el proveedor que envía operaciones SEPA. Disponible en el panel de control del cliente.
    * @param string $merchantCode Identificador único como cuenta PAYCOMET. Disponible en el panel de control del cliente.
    * @param string $merchantCustomerId Identificador único de la cliente del proveedor.
    * @param string $merchantCustomerIban Número de cuenta de la cliente en formato IBAN.
	* @param int $documentType Identificador del tipo de documento en PAYCOMET.
    * @param string $fileContent Contenido binario del archivo a enviar, codificado en base 64.
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function addDocument($terminal,$documentType,$merchantCode,$merchantCustomerIban,$merchanCusotmerId,$sepaProviderId,$filecontent){

    $postFields = array(
"terminal" => $terminal,
"documentType" => $documentType,
"merchantCode" => $merchantCode,
"merchantCustomerIban" => $merchantCustomerIban,
"merchantCustomerId" => $merchanCusotmerId,
"sepaProviderId" => $sepaProviderId,
"fileContent" => $filecontent
);

    //var_dump($jsonPostFields);
    //die();
    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/sepa/add-document',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

/**
	* Cancela un pedido SEPA
	* @param int $terminal ID de producto o terminal.
	* @param int $sepaProviderId Identificador único asignado por PAYCOMET para el proveedor que envía operaciones SEPA. Disponible en el panel de control del cliente.
    * @param string $merchantCode Identificador único como cuenta PAYCOMET. Disponible en el panel de control del cliente.
    * @param int $operationOrder Referecia de la operación
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function sepaCancel($terminal,$sepaProviderId,$merchantCode,$operationOrder){

    $postFields = array(
"terminal" => $terminal,
"sepaProviderId" => $sepaProviderId,
"merchantCode" => $vmerchantCode,
"operationOrder" => $operationOrder,
);

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/sepa/cancel',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

/**
	* Consultar la documentación SEPA de un cliente
	* @param int $terminal ID de producto o terminal.
	* @param int $sepaProviderId Identificador único asignado por PAYCOMET para el proveedor que envía operaciones SEPA. Disponible en el panel de control del cliente.
    * @param string $merchantCode Identificador único como cuenta PAYCOMET. Disponible en el panel de control del cliente.
    * @param string $merchantCustomerId Identificador único de la cliente del proveedor.
	* @param string $merchantCustomerIban Número de cuenta de la cliente en formato IBAN.
    * @param int $documentType Identificador del tipo de documento en PAYCOMET
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function checkCustomer($terminal,$sepaProviderId,$merchantCode,$merchatCustomerId,$merchatCustomerIban,$merchatCustomerType){

    $postFields = array(
"terminal" => $terminal,
"sepaProviderId" => $sepaProviderId,
"merchantCode" => $merchantCode,
"merchantCustomerId" => $merchatCustomerId,
"merchantCustomerIban" => $merchatCustomerIban,
"merchantCustomerType" => $merchatCustomerType,
);

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/sepa/check-customer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '.$this->$API_KEY

        ),
        ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

/**
	* Consultar un documento SEPA
	* @param int $terminal ID de producto o terminal.
	* @param int $sepaProviderId Identificador único asignado por PAYCOMET para el proveedor que envía operaciones SEPA. Disponible en el panel de control del cliente.
    * @param string $merchantCode Identificador único como cuenta PAYCOMET. Disponible en el panel de control del cliente.
    * @param string $merchantCustomerId Identificador único de la cliente del proveedor.
	* @param string $merchantCustomerIban Número de cuenta de la cliente en formato IBAN.
    * @param int $documentType Identificador del tipo de documento en PAYCOMET
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function checkDocument($documentType,$merchantCode,$merchantCustomerId,$merchatCustomerIban,$sepaProviderId,$terminal){

    $postFields = array(
"terminal" => $terminal,
"sepaProviderId" => $sepaProviderId,
"merchantCode" => $merchantCode,
"merchantCustomerId" => $merchantCustomerId,
"merchantCustomerIban" => $merchatCustomerIban,
"documentType" => $documentType
);

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/sepa/check-document',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

/**
	* Realiza una transferencia a otras cuentas en PAYCOMET
	* @param int $sepaProviderId Identificador único asignado por PAYCOMET para el proveedor que envía operaciones SEPA. Disponible en el panel de control del cliente.
	* @param int $terminal ID de producto o terminal.
    * @param int $operationType Tipo de operación. Identifica si la operación es una domiciliación o una transferencia. 1 – Débito Directo (N19) 2 – Transferencia (N34)
    * @param string $merchantCode Identificador único como cuenta PAYCOMET. Disponible en el panel de control del cliente.
	* @param int $terminalIDDebtor Este será el número de terminal asignado al producto. Obtenido del panel de control. Identifica el número de terminal del deudor/pagador de una operación SEPA. Por tanto, dependerá del tipo de operación (débito, transferencia).
    * @param string $uniqueIdCreditor Este será el identificador único de este individuo, autónomo, empresa (destinatario) en el cliente.
    * @param string $companyNameCreditor Nombre de la empresa, persona física o autónoma correspondiente al indicador anterior.
	* @param string $ibanNumberCreditor Código IBAN de la cuenta de la destinataria.
    * @param string $swiftCodeCreditor Código SWIFT de la cuenta bancaria del destinatario. Debe facilitarse cuando el IBAN de la cuenta no sea español. Si el número ibanNumberCreditor pertenece a una cuenta española, debe enviarse como una cadena vacía.
    * @param int $companyTypeCreditor Identificador del tipo de destinatario: 1: Particular / 2: Autónomo / 3: Empresa Comercial.
	* @param string $operationOrder Referencia única de la operación.
    * @param int $operationAmount Importe en la divisa de la transacción con 2 decimales en formato entero: (2,25€ = 225).
    * @param string $operationCurrency Tipo de moneda de la transacción. La única moneda permitida es el euro, cuyo código es EUR.
	* @param string $operationDatetime Fecha deseada para el envío de la operación / remesa SEPA. Siempre después de la fecha actual. Formato: aaaammdd.
    * @param string $operationConcept Concepto asignado a la operación/remesa. Este es el descriptor que aparecerá en los asientos bancarios. Longitud máxima 100. Aunque el error 1273 especificaba 140 caracteres, PAYCOMET se reserva 40, por lo que el máximo permitido en la entrada son 100. Caracteres permitidos: ([A-Za-z0-9]|[+|?|/|-|:| (|)|.|,|'| ])
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/


public function sepaOperation($sepaProviderId,$terminal,$operationType,$merchantCode,$terminalIDDebtor,$uniqueIdCreditor,$companyNameCreditor,$ibanNumberCreditor,$swiftCodeCreditor,$companyTypeCreditor,$operationOrder,$operationAmount,$operationCurrency,$operationDatetime,$operationConcept){

    $operations = array(
        "operationType" => $operationType,
        "merchantCode" => $merchantCode,
        "terminalIDDebtor" => $terminalIDDebtor,
        "uniqueIdCreditor" => $uniqueIdCreditor,
        "companyNameCreditor" => $companyNameCreditor,
        "ibanNumberCreditor" => $ibanNumberCreditor,
        "swiftCodeCreditor" => $swiftCodeCreditor,
        "companyTypeCreditor" => $companyTypeCreditor,
        "operationOrder" => $operationOrder,
        "operationAmount" => $operationAmount,
        "operationCurrency" => $operationCurrency,
        "operationDatetime" => $operationDatetime,
        "operationConcept" => $operationConcept
        );
    $postFields = array(
        "terminal" => $terminal,
        "sepaProviderId" => $sepaProviderId,
        "operations" => [$operations],

        );
    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/sepa/operations',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}
/**
	* Realiza una transferencia a otras cuentas en PAYCOMET
	* @param string $splitId Identificador para que recibas pagos fraccionados
	* @param int $amount Importe de la operación
    * @param string $currency Moneda de la transacción
    * @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $AuthCode Código de autorización de la transacción (requerido para ejecutar un split)
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/

public function splitTransfer($splitId,$amount,$currency,$terminal,$order,$authCode){
   
    $submerchant = new stdClass();
    $submerchant->splitId = $splitId;
    $submerchant->amount = $amount;
    $submerchant->currency = $currency;

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->order = $order;
    $payment->authCode = $authCode;
    

    $postFields = array( "submerchant"=> $submerchant, "payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/marketplace/split-transfer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}
/**
	* Ejecuta una reversión de transferencia dividida basada en una transferencia dividida anterior
	* @param string $splitId Identificador para que recibas pagos fraccionados
	* @param int $amount Importe de la operación
    * @param string $currency Moneda de la transacción
	* @param string $splitAuthCode Código de autorización de la transferencia dividida original
    * @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $AuthCode Código de autorización de la transacción (requerido para ejecutar un split)
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function splitTransferReversal($splitId,$amount,$currency,$splitAuthCode,$terminal,$order,$authCode){
   
    $submerchant = new stdClass();
    $submerchant->splitId = $splitId;
    $submerchant->amount = $amount;
    $submerchant->currency = $currency;
    $submerchant->splitAuthCode = $splitAuthCode;

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->order = $order;
    $payment->authCode = $authCode;
    

    $postFields = array( "submerchant"=> $submerchant, "payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/marketplace/split-transfer-reversal',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}

/**
	*Ejecutar una transferencia
	* @param string $splitId Identificador para que recibas pagos fraccionados
	* @param int $amount Importe de la operación
    * @param string $currency Moneda de la transacción
    * @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function transfer($splitId,$amount,$currency,$terminal,$order){
   
    $submerchant = new stdClass();
    $submerchant->splitId = $splitId;
    $submerchant->amount = $amount;
    $submerchant->currency = $currency;

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->order = $order;
    

    $postFields = array( "submerchant"=> $submerchant, "payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/marketplace/transfer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}
/**
	* Realiza una reversión de transferencia basada en una transferencia anterior
	* @param string $splitId Identificador para que recibas pagos fraccionados
	* @param int $amount Importe de la operación
    * @param string $currency Moneda de la transacción
	* @param string $splitAuthCode Código de autorización de la transferencia dividida original
    * @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function transferReversal($splitId,$amount,$currency,$splitAuthCode,$terminal,$order){
   
    $submerchant = new stdClass();
    $submerchant->splitId = $splitId;
    $submerchant->amount = $amount;
    $submerchant->currency = $currency;
    $submerchant->splitAuthCode = $splitAuthCode;

    $payment = new stdClass();
    $payment->terminal = $terminal;
    $payment->order = $order;
    

    $postFields = array( "submerchant"=> $submerchant, "payment" => $payment );

    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/marketplace/transfer-reversal',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '.$this->$API_KEY

),
));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}

/**
	* Lanza una autorizacion mediante email o sms
	* @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $amount Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
	* @param string $currency Moneda de la transacción.
    * @param string $methodId ID del método de pago PAYCOMET. 1 es para tarjeta.
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
    * @param int $secure 0 o 1. Indica si la transacción es segura.
	* @param string $language Código de idioma ISO2.
    * @param string $smsEmail Canal de envío de la url de pago. Debe ser "sms" o "correo electrónico".
	* @param int $templateId ID de plantilla de correo electrónico o SMS a enviar. Puede obtenerlo en el Panel de control.
    * @param string $emailAddressSmsPrefix Dependera de lo indicado en el campo smsEmail, se debera introducir o el email o el prefijo del numero de telefono
	* @param string $emailNameSmsNumber Dependera de lo indicado en el campo smsEmail, se debera introducir el nombre del receptor o el numero de telefono
    * @param string $scoring (Opcional)Valor de puntuación de riesgo de 0 a 100.
    * @param string $sca_exception (Opcional) TIPO DE EXCEPCIÓN AL PAGO SEGURO. Si no se especifica, PAYCOMET intentará asignarle la más adecuada posible
	* @param string $trx_type Fecha (Opcional) Obligatorio solo si se ha seleccionado una excepción MIT en scaException
	* @param string $productDescription (Opcional) DEscripción del producto vendido
	* @return object (Opcional)Objeto Información de autenticación del cliente. Cuanta más información se proporcione en este campo, más probable será la autorización de la operación sin requerir autenticación adicional. Por esta razón, se recomienda enviar la mayor cantidad de información posible.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function launchAuthorization( $amount,$methodId, $currency,$language,$order,$originalIp,$secure,$templateId,$terminal,$smsEmail,$emailAddressSmsPrefix,$emailNameSmsNumber,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null,  $merchant_data = null)
{
    $postFields = array(
    "amount" => $amount,
            "currency" => $currency,
            "language" => $language,
            "order" => $order,
            "methodId" => $methodId,
            "originalIp" => $originalIp,
            "secure" => $secure,
            "templateId" => $templateId,
            "terminal" => $terminal
        );
     
        if ($sca_exception){
            $postFields["scaException"]= $sca_exception;
        }
        if ($trx_type){
            $postFields["trxType"]= $trx_type;

        }
        if ($productDescription){
            $postFields["productDescription"]= $productDescription;
            
        }
        
        if ($scoring) {
            $postFields["scoring"]= $scoring;

        }
    
        if ($merchant_data){
            $postFields["merchantData"]= $merchant_data;
        }
    if ($smsEmail=='email') {
        $postFields["smsEmail"]= $smsEmail;
        $postFields["emailAddress"]= $emailAddressSmsPrefix;
        $postFields["emailName"]= $emailNameSmsNumber;
        
    } else {

        $postFields["smsEmail"]= $smsEmail;
        $postFields["smsPrefix"]= $emailAddressSmsPrefix;
        $postFields["smsNumber"]= $emailNameSmsNumber;
        
    }
    
    
    $jsonPostFields = json_encode($postFields);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/launchpad/authorization',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 

/**
	* Lanza una preautorización mediante email o sms
	* @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $amount Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
	* @param string $currency Moneda de la transacción.
    * @param string $methodId ID del método de pago PAYCOMET. 1 es para tarjeta.
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
    * @param int $secure 0 o 1. Indica si la transacción es segura.
	* @param string $language Código de idioma ISO2.
    * @param string $smsEmail Canal de envío de la url de pago. Debe ser "sms" o "correo electrónico".
	* @param int $templateId ID de plantilla de correo electrónico o SMS a enviar. Puede obtenerlo en el Panel de control.
    * @param string $emailAddressSmsPrefix Dependera de lo indicado en el campo smsEmail, se debera introducir o el email o el prefijo del numero de telefono
	* @param string $emailNameSmsNumber Dependera de lo indicado en el campo smsEmail, se debera introducir el nombre del receptor o el numero de telefono
    * @param string $scoring (Opcional)Valor de puntuación de riesgo de 0 a 100.
    * @param string $sca_exception (Opcional) TIPO DE EXCEPCIÓN AL PAGO SEGURO. Si no se especifica, PAYCOMET intentará asignarle la más adecuada posible
	* @param string $trx_type Fecha (Opcional) Obligatorio solo si se ha seleccionado una excepción MIT en scaException
	* @param string $productDescription (Opcional) DEscripción del producto vendido
	* @return object (Opcional)Objeto Información de autenticación del cliente. Cuanta más información se proporcione en este campo, más probable será la autorización de la operación sin requerir autenticación adicional. Por esta razón, se recomienda enviar la mayor cantidad de información posible.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function launchPreautorization( $amount,$methodId, $currency,$language,$order,$originalIp,$secure,$templateId,$terminal,$smsEmail,$emailAddressSmsPrefix,$emailNameSmsNumber,$sca_exception = null, $trx_type = null,$productDescription=null, $scoring = null, $merchant_data = null)
{
    $postFields = array(
        "amount" => $amount,
                "currency" => $currency,
                "language" => $language,
                "order" => $order,
                "methodId" => $methodId,
                "originalIp" => $originalIp,
                "secure" => $secure,
                "templateId" => $templateId,
                "terminal" => $terminal
            );
           
            if ($sca_exception){
                $postFields["scaException"]= $sca_exception;
            }
            if ($trx_type){
                $postFields["trxType"]= $trx_type;
    
            }
            if ($productDescription){
                $postFields["productDescription"]= $productDescription; 
            }
            
            if ($scoring) {
                $postFields["scoring"]= $scoring;
            }
            if ($merchant_data){
                $postFields["merchantData"]= $merchant_data;
            }
        if ($smsEmail=='email') {
            $postFields["smsEmail"]= $smsEmail;
            $postFields["emailAddress"]= $emailAddressSmsPrefix;
            $postFields["emailName"]= $emailNameSmsNumber;
            
        } else {
    
            $postFields["smsEmail"]= $smsEmail;
            $postFields["smsPrefix"]= $emailAddressSmsPrefix;
            $postFields["smsNumber"]= $emailNameSmsNumber;
            
        }
   
    
    $jsonPostFields = json_encode($postFields);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/launchpad/preauthorization',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 
/**
	* Lanza una suscripción mediante email o sms
	* @param int $terminal ID de producto o terminal.
	* @param string $order Referencia única para la compra del comerciante
    * @param string $amount Importe de la operación en formato numérico. 1,00 EUROS = 100, 4,50 EUROS = 450...
	* @param string $currency Moneda de la transacción.
    * @param string $methodId ID del método de pago PAYCOMET. 1 es para tarjeta.
	* @param string $originalIp Dirección IP del cliente que inició la transacción de pago
    * @param int $secure 0 o 1. Indica si la transacción es segura.
	* @param string $language Código de idioma ISO2.
    * @param string $smsEmail Canal de envío de la url de pago. Debe ser "sms" o "correo electrónico".
	* @param int $templateId ID de plantilla de correo electrónico o SMS a enviar. Puede obtenerlo en el Panel de control.
    * @param string $emailAddressSmsPrefix Dependera de lo indicado en el campo smsEmail, se debera introducir o el email o el prefijo del numero de telefono
	* @param string $emailNameSmsNumber Dependera de lo indicado en el campo smsEmail, se debera introducir el nombre del receptor o el numero de telefono
    * @param string $scoring (Opcional)Valor de puntuación de riesgo de 0 a 100.
    * @param string $startDate Fecha de inicio de la suscripción aaaammdd. IMPORTANTE Las suscripciones se cobran en la primera ejecución si este campo tiene valor se tendrá en cuenta para futuros cargos.
	* @param string $endDate Fecha de finalización de la suscripción aaaammdd
    * @param string $periodicity Periodicidad de suscripción en días. Máximo 365.
	* @return object (Opcional)Objeto Información de autenticación del cliente. Cuanta más información se proporcione en este campo, más probable será la autorización de la operación sin requerir autenticación adicional. Por esta razón, se recomienda enviar la mayor cantidad de información posible.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function launchSubscription($startDate,$endDate,$periodicity, $amount,$methodId, $currency,$language,$order,$originalIp,$secure,$templateId,$terminal,$smsEmail,$emailAddressSmsPrefix,$emailNameSmsNumber, $scoring = null, $merchant_data = null)
{
            $postFields = array(
            "startDate" => $startDate,
            "endDate" => $endDate,
            "periodicity" => $periodicity,
            "amount" => $amount,
            "currency" => $currency,
            "language" => $language,
            "order" => $order,
            "methodId" => $methodId,
            "originalIp" => $originalIp,
            "secure" => $secure,
            "templateId" => $templateId,
            "terminal" => $terminal
            );
           
            if ($scoring) {
                $postFields["scoring"]= $scoring;
            }
           
            if ($merchant_data){
                $postFields["merchantData"]= $merchant_data;
            }
        if ($smsEmail=='email') {
            $postFields["smsEmail"]= $smsEmail;
            $postFields["emailAddress"]= $emailAddressSmsPrefix;
            $postFields["emailName"]= $emailNameSmsNumber;   
        } else {
            $postFields["smsEmail"]= $smsEmail;
            $postFields["smsPrefix"]= $emailAddressSmsPrefix;
            $postFields["smsNumber"]= $emailNameSmsNumber;
        }

    $jsonPostFields = json_encode($postFields);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/launchpad/subscription',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 
/**
	* Obtiene la sesión ivr
	* @param int $terminal ID de producto o terminal.
	* @param int $ivrProviderId Código proveedor / integrador IVR.
    * @param string $ivrStationId Identificador de ubicación
	* @param int $ivrMerchantAmount Importe de la operación en formato completo. 1,00 EUROS = 100, 4,50 EUROS = 450...
    * @param string $ivrMerchantCurrency Moneda de transacción.
	* @param string $ivrMerchantOrder Referencia de la operación. Debe ser único en cada transacción válida. IMPORTANTE EN CASO DE SUSCRIPCIONES No incluir los caracteres “[“ o “]”, se utilizarán para reconocer al idUsuario de la empresa.
    * @param string $ivrMerchantLanguage Idioma (iso2) en el que se enviarán las frases IVR
	* @param string $ivrTransactionType Tipos posibles 107 Registro de usuario de banco 1 Autorización 3 Preautorización 9 Suscripción
    * @param string $ivrMerchantConcept (Opcional) Concepto de operación
	* @param string $ivrSubscriptionStartdate (Opcional) Obligatorio en suscripciones. Fecha de inicio de la suscripción.
    * @param string $ivrSubscriptionEnddate (Opcional) Obligatorio en suscripciones. Fecha de finalización de la suscripción.
	* @param int $ivrSubscriptionPeriodicity (Opcional) Obligatorio en suscripciones. Periodicidad del pago desde la fecha de inicio. El número se expresa en Días. No puede ser más de 365 días.
    * @param int $ivrMaxRetries (Opcional) Número de intentos permitidos.
	* @param int $ivrSessionTimeout (Opcional) Tiempo máximo de sesión. En segundos.
    * @param string $ivrCallbackStationTimeout (Opcional) Prórroga de devolución en caso de tiempo límite.
    * @param string $ivrCallbackStationOk (Opcional) Prórroga de devolución en caso de funcionamiento OK.
	* @param string $ivrCallbackStationKo (Opcional)Prórroga de devolución en caso de funcionamiento KO.
    * @param string $ivrCallerPhoneNumber (Opcional) Número de llamada entrante.
	* @param string $ivrProviderData01 Campo opcional.
    * @param string $ivrProviderData02 Campo opcional.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/

public function getSession($ivrMerchantAmount,$ivrMerchantCurrency,$ivrMerchantLanguage, $ivrMerchantOrder,$ivrProviderId, $ivrStationId,$ivrTransactionType,$terminal,$ivrMerchantConcept=null,$ivrSubscriptionStartdate=null,$ivrSubscriptionEnddate=null,$ivrSubscriptionPeriodicity=null,$ivrMaxRetries=null,$ivrSessionTimeout=null,$ivrCallbackStationTimeout=null,$ivrCallbackStationOk=null,$ivrCallbackStationKo=null,$ivrCallerPhoneNumber=null,$ivrProviderData01=null,$ivrProviderData02=null)
{
    

        $postFields = array(
            "ivrMerchantAmount" => $ivrMerchantAmount,
            "ivrMerchantCurrency" => $ivrMerchantCurrency,
            "ivrMerchantLanguage" => $ivrMerchantLanguage,
            "ivrMerchantOrder" => $ivrMerchantOrder,
            "ivrProviderId" => $ivrProviderId,
            "ivrStationId" => $ivrStationId,
            "ivrTransactionType" => $ivrTransactionType,
            "terminal" => $terminal
            );
          
            if ($ivrMerchantConcept) {
                $postFields["ivrMerchantConcept"]= $ivrMerchantConcept;
            }
        
            if ($ivrSubscriptionStartdate) {
                $postFields["ivrSubscriptionStartdate"]= $ivrSubscriptionStartdate;
            }
            if ($ivrSubscriptionEnddate) {
                $postFields["ivrSubscriptionEnddate"]= $ivrSubscriptionEnddate;
            }
        
            if ($ivrSubscriptionPeriodicity) {
                $postFields["ivrSubscriptionPeriodicity"]= $ivrSubscriptionPeriodicity;
            }
            if ($ivrMaxRetries) {
                $postFields["ivrMaxRetries"]= $ivrMaxRetries;
            }
        
            if ($ivrSessionTimeout) {
                $postFields["ivrSessionTimeout"]= $ivrSessionTimeout;
            }
            if ($ivrCallbackStationTimeout) {
                $postFields["ivrCallbackStationTimeout"]= $ivrCallbackStationTimeout;
            }
        
            if ($ivrCallbackStationOk) {
                $postFields["ivrCallbackStationOk"]= $ivrCallbackStationOk;
            }
            if ($ivrCallbackStationKo) {
                $postFields["ivrCallbackStationKo"]= $ivrCallbackStationKo;
            }
            if ($ivrCallerPhoneNumber) {
                $postFields["ivrCallerPhoneNumber"]= $ivrCallerPhoneNumber;
            }
            if ($ivrProviderData01) {
                $postFields["ivrProviderData01"]= $ivrProviderData01;
            }
            if ($vrProviderData02) {
                $postFields["ivrProviderData02"]= $ivrProviderData02;
            }


    $jsonPostFields = json_encode($postFields);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/ivr/get-session',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 

/**
	* Comprueba la sesion ivr
	* @param int $terminal ID de producto o terminal.
	* @param int $ivrProviderId Código proveedor / integrador IVR.
    * @param string $ivrMerchantOrder Referencia de la operación. Debe ser único en cada transacción válida. IMPORTANTE EN CASO DE SUSCRIPCIONES No incluir los caracteres “[“ o “]”, se utilizarán para reconocer al idUsuario de la empresa.
	* @return object Objeto de respuesta de la operación
	* @version 2.0 03/05/2022
	*/
public function checkSession($ivrMerchantOrder,$ivrProviderId,$terminal)
{
    

        $postFields = array(
            "ivrMerchantOrder" => $ivrMerchantOrder,
            "ivrProviderId" => $ivrProviderId,
            "terminal" => $terminal
            
            );

    $jsonPostFields = json_encode($postFields);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/ivr/session-state',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 
/**
	* Cancela la sesión ivr
	* @param int $terminal ID de producto o terminal.
	* @param int $ivrProviderId Código proveedor / integrador IVR.
    * @param string $ivrMerchantOrder Referencia de la operación. Debe ser único en cada transacción válida. IMPORTANTE EN CASO DE SUSCRIPCIONES No incluir los caracteres “[“ o “]”, se utilizarán para reconocer al idUsuario de la empresa.
	* @return object Objeto de respuesta de la operación
	* @version  2.0 03/05/2022
	*/
public function sessionCancel($ivrMerchantOrder,$ivrProviderId,$terminal)
{
    

        $postFields = array(
            "ivrMerchantOrder" => $ivrMerchantOrder,
            "ivrProviderId" => $ivrProviderId,
            "terminal" => $terminal
            
            );

    $jsonPostFields = json_encode($postFields);
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/ivr/session-cancel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'PAYCOMET-API-TOKEN: '.$this->$API_KEY

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
} 

}
?>