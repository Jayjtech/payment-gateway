<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="js/sweetalert.js"></script>

<?php
// SWEETALERT
if(isset($_SESSION['message'])): ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['message']; ?>",
            text: "<?php echo $_SESSION['help']; ?>",
            icon: "<?php echo $_SESSION['msg_type']; ?>",
            button: "<?php echo $_SESSION['btn']; ?>",
        });
    </script>

    <?php 
        unset($_SESSION['message']);
        endif;
    ?>
    </body>
</html>