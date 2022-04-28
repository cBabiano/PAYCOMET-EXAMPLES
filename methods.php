<?php
class Paycomet_Rest
{
    private $api_key = "";

    public function __construct($arg1)
	{
        $api_key = "";
		$this->$api_key = $arg1;
	
	}
public function form($operationtype, $lenguage, $terminal,$order,$amount,$currency,$secure)
	{
        $api_key = "";
        $valores = array (
            'operationType' => $operationtype,
            'language' => $lenguage,
            'terminal' =>  $terminal,
            'order'=> $order,
            'amount' =>  $amount,
            'currency' =>  $currency,
            'secure' =>  $secure,
            'metod' => [1],
            'apikey'=> $this->$api_key
            );
         
         
            
        $payment = new stdClass();
        $payment->terminal = $valores['terminal'];//propiedades del objeto payments
        $payment->order = $valores['order'];//propiedades del objeto payments
        $payment->methods = array('operationType'); //propiedades del objeto payments
        $payment->currency = $valores['currency'];//propiedades del objeto payments
        $payment->secure = $valores['secure'];//propiedades del objeto payments
        $payment->amount = $valores['amount'];//propiedades del objeto payments
        $payment->methods = $valores['metod'];
            
        $postFields = array(
        "operationType" => $valores['operationType'],
        "language" => $valores['language'],
        "payment" => $payment

        );

        

        //var_dump($jsonPostFields);
        //die();
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
                'PAYCOMET-API-TOKEN: '.$valores['apikey']

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}

    public function addUser($terminal, $cvc2, $expiryyear,$expirymonth,$pan,$order,$lenguage,$cardholdername,$productdescription)
	{
        

        $postFields = array(
        "terminal" => $valores[$terminal],
        "order" => $valores[$order],
        "pan" => $pan,
        "expiryMonth" => $expirymonth,
        "expiryYear" => $expiryyear,
        "cvc2" => $cvc2,
        "procducDescripto" => $productdescription,
        "lenguage" => $lenguage,
        );

        //var_dump($jsonPostFields);
        //die();
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
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}    
    public function addUserTokenTmp($jetToekn, $terminal)
	{
        

        $postFields = array(
        "terminal" => $valores[$terminal],
        "jetToken" => $valores[$jetToekn],
        
        );

        //var_dump($jsonPostFields);
        //die();
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
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}  

public function executePurchase($terminal, $order, $amount,$currency,$originalip,$methodid, $iduser,$tokeuser,$secure,$productdescription = null, $owner = null, $scoring = null, $merchant_data = null, $merchant_description = null, $sca_exception = null, $trx_type = null, $scrow_targets = null, $user_interaction = null)
	{
        $payment = new stdClass();
        $payment->terminal = $valores[$terminal];//propiedades del objeto payments
        $payment->order = $valores[$order];//propiedades del objeto payments
        $payment->amount = $valores($amount); //propiedades del objeto payments
        $payment->currency = $valores[$currency];//propiedades del objeto payments
        $payment->originalip = $valores[$originalip];//propiedades del objeto payments
        $payment->methodid = $valores[$methodid];//propiedades del objeto payments

        $payment->iduser = $valores[$iduser];//propiedades del objeto payments
        $payment->toneuser = $valores[$tokeuser];//propiedades del objeto payments
        $payment->secure = $valores[$secure];//propiedades del objeto payments
        
        $postFields = array(
        "payment" => $payment,
        
        );
        
        //var_dump($jsonPostFields);
        //die();
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
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}
    public function executeRefund($order,$terminal, $amount,$currency,$originalip,$authCode, $iduser,$tokeuser,$notifyPayment )
	{
        $payment = new stdClass();
        $payment->terminal = $valores[$terminal];//propiedades del objeto payments
        $payment->amount = $valores($amount); //propiedades del objeto payments
        $payment->currency = $valores[$currency];//propiedades del objeto payments
        $payment->originalip = $valores[$originalip];//propiedades del objeto payments
        $payment->authcode = $valores[$authCode];//propiedades del objeto payments
        $payment->iduser = $valores[$iduser];//propiedades del objeto payments
        $payment->toneuser = $valores[$tokeuser];//propiedades del objeto payments
        $payment->notifydirectpayment = $valores[$notifyPayment];//propiedades del objeto payments
        
        $postFields = array(
        "payment" => $payment,
        
        );
        
        //var_dump($jsonPostFields);
        //die();
        $jsonPostFields = json_encode($postFields);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'+$order+'/refund',
        CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}
public function balance($terminal){



   
    $payment = new stdClass();
    $payment->terminal = $valores[$terminal];//propied
    $postFields = array(
    "terminal" => $valores[$terminal],
);

    //var_dump($jsonPostFields);
    //die();
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
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
  

}    
public function preauth($terminal,$order,$amount,$currency,$originalip,$methodid,$iduser,$tokeuser,$secure){

    $payment = new stdClass();
    $payment->terminal = $valores[$terminal];//propiedades del objeto payments
    $payment->order = $valores[$order];//propiedades del objeto payments
    $payment->amount = $valores($amount); //propiedades del objeto payments
    $payment->currency = $valores[$currency];//propiedades del objeto payments
    $payment->originalip = $valores[$originalip];//propiedades del objeto payments
    $payment->methodid = $valores[$methodid];//propiedades del objeto payments

    $payment->iduser = $valores[$iduser];//propiedades del objeto payments
    $payment->toneuser = $valores[$tokeuser];//propiedades del objeto payments
    $payment->secure = $valores[$secure];//propiedades del objeto payments

    $postFields = array(
    "payment" => $payment,
    
    );
    
    //var_dump($jsonPostFields);
    //die();
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
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

}
public function preauth_cancel($order,$terminal,$amount,$originalip,$authcode){
    $postFields = array(
        "terminal" => $valores[$terminal],
        "amount" => $valores[$amount],
        "originalip" => $valores[$originalip],
        "authcode" => $valores[$authcode],
        );

        //var_dump($jsonPostFields);
        //die();
        $jsonPostFields = json_encode($postFields);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'+$order+'/preauth/cancel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
      
}
public function preauth_confirm($order,$terminal,$amount,$originalip,$authcode){
    $postFields = array(
        "terminal" => $valores[$terminal],
        "amount" => $valores[$amount],
        "originalip" => $valores[$originalip],
        "authcode" => $valores[$authcode],
        );

        //var_dump($jsonPostFields);
        //die();
        $jsonPostFields = json_encode($postFields);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.paycomet.com/v1/payments/'+$order+'/preauth/cancel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPostFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Connection: Keep-Alive',
                'PAYCOMET-API-TOKEN: '+$API_KEY+''

        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
      
}
public function suscription($starDate,$endDate,$periodicity,$amount,$currency,$methodId,$idUser,$tokenUser,$order,$originalIp,$termianl,$sercure){
    $suscription = new stdClass();
    $suscription->startdate = $valoressusc[$starDate];//propiedades del objeto payments
    $suscription->enddate = $valoressusc[$endDate];//propiedades del objeto payments
    $suscription->periodicity = $valoressusc[$periodicity];//propiedades del objeto payments    

    $payment = new stdClass();
    $payment->terminal = $valores[$terminal];//propiedades del objeto payments
    $payment->mehtodId = $valores[$methodId];//propiedades del objeto payments
    $payment->order = $valores[$order];; //propiedades del objeto payments
    $payment->amount = $valores[$amount];//propiedades del objeto payments
    $payment->currecncy = $valores[$currency];//propiedades del objeto payments
    $payment->originalIp = $valores[$originalIp];//propiedades del objeto payments
    $payment->iduser = $valores[$idUser];//propiedades del objeto payments
    $payment->tokeuser = $valores[$tokenUser];//propiedades del objeto payments$payment->currecncy = $valores['secure'];//propiedades del objeto payments
    $payment->secure = $valores[$secure];//propiedades del objeto payments

    $postFields = array(
    "suscription"=> $suscription,
    "payment" => $payment,

    );

    //var_dump($jsonPostFields);
    //die();
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
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}
public function suscriptionEdit($order,$starDate,$endDate,$periodicity,$termianl,$methodId,$amount,$originalIp,$idUser,$tokenUser){
    $suscription = new stdClass();
    $suscription->startdate = $valoressusc[$starDate];//propiedades del objeto payments
    $suscription->enddate = $valoressusc[$endDate];//propiedades del objeto payments
    $suscription->periodicity = $valoressusc[$periodicity];//propiedades del objeto payments    

    $payment = new stdClass();
    $payment->terminal = $valores[$terminal];//propiedades del objeto payments
    $payment->mehtodId = $valores[$methodId];//propiedades del objeto payments
    $payment->amount = $valores[$amount];//propiedades del objeto payments
    $payment->originalIp = $valores[$originalIp];//propiedades del objeto payments
    $payment->iduser = $valores[$idUser];//propiedades del objeto payments
    $payment->tokeuser = $valores[$tokenUser];//propiedades del objeto payments$payment->currecncy = $valores['secure'];//propiedades del objeto payments


    $postFields = array(
    "suscription"=> $suscription,
    "payment" => $payment,

    );

    //var_dump($jsonPostFields);
    //die();
    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription'+$order+'/edit',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}
public function suscriptionRemove($order,$termianl,$methodId,$idUser,$tokenUser){
   

    $payment = new stdClass();
    $payment->terminal = $valores[$terminal];//propiedades del objeto payments
    $payment->mehtodId = $valores[$methodId];//propiedades del objeto payments
    $payment->order = $valores[$order];//propiedades del objeto payments
    $payment->iduser = $valores[$idUser];//propiedades del objeto payments
    $payment->tokeuser = $valores[$tokenUser];//propiedades del objeto payments$payment->currecncy = $valores['secure'];//propiedades del objeto payments


    $postFields = array(
    "payment" => $payment,

    );

    //var_dump($jsonPostFields);
    //die();
    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription/'+$order+'/remove',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

} 
public function suscriptionInfo($order,$termianl,$methodId,$idUser,$tokenUser){
   

    $payment = new stdClass();
    $payment->terminal = $valores[$terminal];//propiedades del objeto payments
    $payment->mehtodId = $valores[$methodId];//propiedades del objeto payments
    $payment->iduser = $valores[$idUser];//propiedades del objeto payments
    $payment->tokeuser = $valores[$tokenUser];//propiedades del objeto payments$payment->currecncy = $valores['secure'];//propiedades del objeto payments


    $postFields = array(
    "payment" => $payment,

    );

    //var_dump($jsonPostFields);
    //die();
    $jsonPostFields = json_encode($postFields);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://rest.paycomet.com/v1/subscription/'+$order+'/info',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonPostFields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Connection: Keep-Alive',
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

} 
public function addDocument($terminal,$documentType,$merchantCode,$merchantcustomerIban,$merchanCusotmerId,$sepaProviderId){

    $postFields = array(
"teminal" => $valores['operationType'],
"documenttype" => $valores['language'],
"merchantcode" => $valores['operationType'],
"merchantcustomeriban" => $valores['language'],
"merchantcustomerid" => $valores['language'],
"sepaproviderid" => $valores['operationType'],
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
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
public function sepaCancel($terminal,$sepaProviderId,$merchantCode,$operationOrder){

    $postFields = array(
"teminal" => $valores[$terminal],
"sepaProviderId" => $valores[$sepaProviderId],
"merchantcode" => $valores[$merchantCode],
"operationOrder" => $valores[$operationOrder],
);

    //var_dump($jsonPostFields);
    //die();
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
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
public function checkCustomer($terminal,$sepaProviderId,$merchantCode,$merchatCustomerId,$merchatCustomerIban,$merchatCustomerType){

    $postFields = array(
"teminal" => $valores[$terminal],
"sepaProviderId" => $valores[$sepaProviderId],
"merchantcode" => $valores[$merchantCode],
"merchantcustomerid" => $valores[$merchanCusotmerId],
"merchantcustomeriban" => $valores[$merchanCusotmerIban],
"merchantcustomertype" => $valores[$merchatCustomerType],
);

    //var_dump($jsonPostFields);
    //die();
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
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
public function checkDocument($terminal,$sepaProviderId,$merchantCode,$merchatCustomerId,$merchatCustomerIban,$merchatCustomerType){

    $postFields = array(
"teminal" => $valores[$terminal],
"sepaProviderId" => $valores[$sepaProviderId],
"merchantcode" => $valores[$merchantCode],
"merchantcustomerid" => $valores[$merchanCusotmerId],
"merchantcustomeriban" => $valores[$merchanCusotmerIban],
"merchantcustomertype" => $valores[$merchatCustomerType],
);

    //var_dump($jsonPostFields);
    //die();
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
        'PAYCOMET-API-TOKEN: '+$API_KEY+''

    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
public function sepaOperation(){

    
}
}
?>