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
            background-image: url('background.jpg');
            /* Replace with actual image path */
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
        <h1>Edit Product </h1>
    </div>
    
    <div class="container result-table">
        <button type="button" onclick="location.href='index.php';" class="btn btn-primary" > Home </button>
        <div id="reader"></div>
        <form method="post" id="productEdit" action="./db/editProduct.php">
            <div class="input-group mb-3">
                <span class="input-group-text">Product Code </span>
                <input type="text" class="form-control" id="barcode" name="barcode" value="<?php if(isset($_SESSION['barcode'])){echo $_SESSION['barcode'];} else {echo '-';};?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Product Name </span>
                <input type="text" class="form-control" id="pnameEdit" name="pnameEdit" value="<?php if(isset($_SESSION['barcode'])){echo $_SESSION['names'];} else {echo '-';};?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Details </span>
                <input type="textarea" class="form-control" id="pdetailsEdit" name="pdetailsEdit" value="<?php if(isset($_SESSION['barcode'])){echo $_SESSION['details'];} else {echo '-';};?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Unit Price </span>
                <input type="number" class="form-control" id="ppriceEdit" name="ppriceEdit" value="<?php if(isset($_SESSION['barcode'])){echo $_SESSION['unit_price'];} else {echo '-';};?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Store Location </span>
                <input type="text" class="form-control" id="store_locEdit" name="store_locEdit" value="<?php if(isset($_SESSION['barcode'])){echo $_SESSION['store_location'];} else {echo '-';};?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Date Added </span>
                <input type="date" class="form-control" id="dateAdd" name="dateAdd" value="<?php if(isset($_SESSION['barcode'])){echo $_SESSION['date_added'];} else {echo '-';};?>" required readonly>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"hidden>Date Edited </span>
                <input type="date" class="form-control" id="dateEdit" name="dateEdit" hidden>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>