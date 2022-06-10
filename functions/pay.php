<?php   
require "../config/db.php";
$redirect_url = 'http://localhost/myApp/functions/paid.php';

    //VALIDATE IF USER WENT THROUGH THE ORDER DETAILS PAGE
     if(!isset($_SESSION['id'])){
        //  If not, redirect to home page
        header('location: index.php');
     }else{
        //  Else proceed with payment process
        
        // I have stored email and name into $email and $name respectively
        $email = 'jayjtech@gmail.com';
        $name = 'Oluwafemi Joshua';
        
        // Generate a unique transaction ID 
        $trx_id = rand(1000000,9999999);
        $description = 'Purchase of '.$_SESSION['pdt_name'].' Unit('.$_SESSION['pdt_qty'].') @ &#8358;'.$_SESSION['amount'].'';
        
        // Save description and transaction ID into SESSION variables
        $_SESSION['description'] = $description;
        $_SESSION['trx_id'] = $trx_id;
        
        //* Prepare our rave request
        $request = [
            'tx_ref' => $trx_id,
            'amount' => $_SESSION['amount'],
            'currency' => 'NGN',
            'payment_options' => 'card',
            'redirect_url' => $redirect_url,
            'customer' => [
                'email' => $email,
                'name' => $name
            ],
            'meta' => [
                'price' => $_SESSION['amount']
            ],
            'customizations' => [
                'title' => 'Purchase of product',
                'description' => $description
            ]
        ];

    //* Call fluterwave endpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$payment_key.'',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);
    $res = json_decode($response);
    curl_close($curl);
    
    if($res->status == 'success'){   
        $link = $res->data->link;
        header('location: '.$link);
    }else{
        $_SESSION['message'] = 'Unable to process payment.';
        $_SESSION['msg_type'] = "error";
        $_SESSION['help'] = "Please try again!";
        $_SESSION['btn'] = "Okay";
        header('location:../order-details.php?id='.$_SESSION['id'].'&pdt_name='.$_SESSION['pdt_name'].'&price='.$_SESSION['price'].'&pdt_qty='.$_SESSION['pdt_qty'].'');
        }
    }
     ?>