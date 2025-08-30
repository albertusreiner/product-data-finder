<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Product Lookup</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

  body {
    background-image: url('background.jpg'); /* Replace with actual image path */
    background-size: cover;
    background-position: center;
  }

  .container {
    max-width: 800px;
    margin: 50px auto;
  }

  .title {
    text-align: center;
    padding: 20px 0;
  }

  .input-group {
    margin-bottom: 20px;
  }

  .result-table {
    overflow-x: auto;
  }
</style>

</head>

<body>
    <div class="container title">
    <h1>Barcode Product Lookup</h1>
    </div>
    <div class="container">
    <form id="productForm" action="./db/getProduct.php" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" >Product Code   </span>
            <input type="text" class="form-control" id="barcode" placeholder="Enter barcode" name="barcode">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#scanModal" id="button-addon2">Scan</button>
        </div>

        <div class="modal" tabindex="-1" id="scanModal">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" id="closeModal"data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="reader"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>   


        <div class="input-group mb-3">
            <span class="input-group-text">Product Name    </span>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>


    


    </div>

    <div class="container result-table">
        <h2>Product Details</h2>
        <table id="productTable" class="table">
            <tbody>
                <tr>
                    <td>Barcode<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['barcode'];} else {echo '-';};?></td>

                </tr>
                <tr>
                    <td>Name<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['names'];} else {echo '-';}; ?></td>

                </tr>
                <tr>
                    <td>Details<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['details'];} else {echo '-';}; ?></td>

                </tr>
                <tr>
                    <td>Price<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['unit_price'];} else {echo '-';}; ?></td>

                </tr>
                <tr>
                    <td>Store Location<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['store_location'];} else {echo '-';}; ?></td>

                </tr>
                <tr>
                    <td>Date Added<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['date_added'];} else {echo '-';}; ?></td>

                </tr>
                <tr>
                    <td>Last Edited<td>
                    <td><?php if(isset($_SESSION['barcode'])){echo $_SESSION['date_edited'];} else {echo '-';}; ?></td>

                </tr>
            </tbody>
            
        </table>
        <div class="center">
            <form><button type="submit" class="btn btn-warning" formaction="./edit.php" <?php if(isset($_SESSION['barcode'])){} else {echo 'disabled';}; ?>>Edit</button>
            <button type="submit" class="btn btn-danger" formaction="./db/reset.php"<?php if(isset($_SESSION['barcode'])){} else {echo 'disabled';}; ?>>Clear</button></form>
            
        </div>

    </div>

    

<script>

    const scanner = new Html5QrcodeScanner('reader', { 
        // Scanner will be initialized in DOM inside element with id of 'reader'
        qrbox: {
            width: 250,
            height: 200,
        },  // Sets dimensions of scanning box (set relative to reader element width)
        fps: 20, // Frames per second to attempt a scan
    });


    scanner.render(success, error);
    // Starts scanner

    function success(result) {
       
        document.getElementById('barcode').value = result;
        // Prints result as a link inside result element

        scanner.clear();
        // Clears scanning instance

        document.getElementById('reader').remove();
        // Removes reader element from DOM since no longer needed

        document.getElementById('closeModal').click();

    }

    function error(err) {
        console.error(err);
        // Prints any errors to the console
    }

</script>

</body>

</html>
