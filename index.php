<?php 
    include "config/db.php";
    $call_pdt = $conn->query("SELECT * FROM products");
?>

<?php include "includes/header.php"; ?>

<div class="container mt-5">
   <h3 class="text-center mb-5">Payment Gateway Tutorial</h3>
   <div class="row">
       <?php while($row = $call_pdt->fetch_assoc()):?>
            <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/<?php echo $row['pdt_img']; ?>" class="img-thumbnail card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['pdt_name']; ?></h5>
                            <p class="card-text">Price: &#8358; <?php echo number_format($row['price']); ?></p>

                            <form action="order-details.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="pdt_name" value="<?php echo $row['pdt_name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" name="pdt_qty" min="1" placeholder="Quantity" class="form-control" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-warning">Buy now </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        <?php endwhile; ?>
   </div>
</div>

<?php include "includes/footer.php"; ?>