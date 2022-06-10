<?php 
require "../config/db.php";
$time = date('H:i:s');
$date = date('Y-m-d');
if(isset($_GET['status'])){
        //* check payment status
        if($_GET['status'] == 'cancelled'){
            // If payment was cancelled
            $_SESSION['message'] = 'You cancelled the transaction.';
            $_SESSION['msg_type'] = "error";
            $_SESSION['help'] = "";
            $_SESSION['btn'] = "Okay";
            header('location:../order-details.php?id='.$_SESSION['id'].'&pdt_name='.$_SESSION['pdt_name'].'&price='.$_SESSION['price'].'&pdt_qty='.$_SESSION['pdt_qty'].'');
        
        }elseif($_GET['status'] == 'successful'){
            // If payment was successful
            $txid = $_GET['transaction_id'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json',
                  'Authorization: Bearer '.$payment_key.''
                ),
              ));
              // Get response from flutterwave
              $response = curl_exec($curl);
              curl_close($curl);
              // Decode json response
              $res = json_decode($response);
            
              if(!empty($txid)){
            //   if transaction ID from flutterwave was generated
                $trx_id = $_SESSION['trx_id'];
                $description = $_SESSION['description'];
                $pdt_name = $_SESSION['pdt_name'];
                $pdt_id = $_SESSION['id'];
                $amount = $_SESSION['amount'];
            }
              if($res->status == 'success'){
                // Save into database (order table) for future reference
                $record = $conn->query("INSERT INTO orders (pdt_name, amount, pdt_id, trx_id, description, time, date) 
                VALUES('$pdt_name', '$amount', '$pdt_id', '$trx_id', '$description', '$time', '$date')");
              if($record){
                // If successfully saved into database
                    $_SESSION['message'] = 'Order successfully placed!';
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['help'] = "";
                    $_SESSION['btn'] = "Okay";
                    header('location: ../index.php');
                }else{
                $_SESSION['message'] = 'Order was not successful!';
                $_SESSION['msg_type'] = "error";
                $_SESSION['help'] = "Please try again!";
                $_SESSION['btn'] = "Okay";
                header('location: ../index.php');
              }          

        }else{
            $_SESSION['message'] = 'Server error, transaction was not successful!';
            $_SESSION['msg_type'] = "error";
            $_SESSION['help'] = "Please try again!";
            $_SESSION['btn'] = "Okay";
            header('location: ../index.php');
            }
        }
    }
?>