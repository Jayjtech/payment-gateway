<?php 
    include "config/db.php";
?>
<?php include "includes/header.php"; ?>

<?php 
        // VALIDATE IF TRUELY A THE BUY BUTTON WAS CLICKED
    if(!isset($_GET['id'])){
        // if it was'nt clicked, redirect to the index page
        header('location: index.php');
    }else{
        // if clicked
        // SAVE ALL DATA INTO VARIABLES
        $id = $_GET['id'];
        $pdt_name = $_GET['pdt_name'];
        $price = $_GET['price'];
        $pdt_qty = $_GET['pdt_qty'];

        // CALCULATE THE GRAND TOTAL (Qty of product x price)
        $amount = ($pdt_qty*$price);

        //SAVE DATA INTO SESSION VARIABLES
        $_SESSION['pdt_name'] = $pdt_name;
        $_SESSION['price'] = $price;
        $_SESSION['pdt_qty'] = $pdt_qty;
        $_SESSION['id'] = $id;
        $_SESSION['amount'] = $amount;
    }
?>
<div class="container mt-5">
    <h4 class="text-center">Order details</h4>
    <div class="container offset-3 mt-5">
        <div class="container">
            <p><strong>Product name: </strong><?php echo $pdt_name; ?></p>
            <p><strong>Quantity: </strong><?php echo $pdt_qty; ?> </p>
            <p><strong>Price/unit: </strong>&#8358;<?php echo number_format($price); ?></p>
            <p><strong>Grand price: </strong>&#8358;<?php echo number_format($amount); ?></p>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <a href="./" class="btn btn-danger">Cancel</a>
                </div>

                <div class="col-sm-6">
                    <a href="functions/pay.php" class="btn btn-primary">Make payment</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>