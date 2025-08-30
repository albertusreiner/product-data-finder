<?php
    session_start();
    include "./dbConnect.php"
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Set parameters and execute
    $barcode = $_POST['barcode'];
    $names = $_POST['pnameAdd'];
    $details = $_POST['pdetailsAdd'];
    $unit_price = $_POST['ppriceAdd'];
    $store_location = $_POST['store_locAdd'];
    $date_added = $_POST['dateAdd']; // Convert to proper date format
    $date_edited = 'current_timestamp()';

// Prepare and bind
    $sql = "INSERT INTO `products` (`id`, `barcode`, `names`, `details`, `unit_price`, `store_location`, `date_added`, `date_edited`) VALUES ('','$barcode', '$names', '$details', '$unit_price', '$store_location', '$date_added', $date_edited)";

    if ($conn-> query($sql) === TRUE) {
        $barcode = null;
        $names = null;
        $details = null;
        $unit_price = null;
        $store_location = null;
        $date_added = null; // Convert to proper date format
        $_POST = array();
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
        $conn->close();

        
    }

    redirect("../index.php");

        function redirect($url) {
            header('Location: '.$url);
            die();
        }
?>


















