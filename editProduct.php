<?php
    session_start();
    include "./dbConnect.php"
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Set parameters and execute
    $barcode = $_POST['barcode'];
    $names = $_POST['pnameEdit'];
    $details = $_POST['pdetailsEdit'];
    $unit_price = $_POST['ppriceEdit'];
    $store_location = $_POST['store_locEdit'];
    $date_added = $_POST['dateAdd']; // Convert to proper date format
    $date_edited = 'current_timestamp()';
    $id = $_SESSION['id'];

// Prepare and bind
    $sql = "UPDATE `products` SET `barcode`= '$barcode', `names`= '$names', `details` = '$details', `unit_price` = '$unit_price', `store_location` = '$store_location', `date_added` = '$date_added', `date_edited` = '$date_edited' 
    WHERE id = '$id';";

    if ($conn-> query($sql) === TRUE) {
        $details = null;
        $unit_price = null;
        $store_location = null;
        $date_added = null; // Convert to proper date format
        $date_edited = null;
        $id = null;
        $_POST = array();
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      };
        

    $sqls = "SELECT * FROM products WHERE barcode = '$barcode' OR names = '$names'";
    $result = $conn->query($sqls);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION = [
            'barcode' => $row["barcode"],
            'names' => $row["names"],
            'details' => $row["details"],
            'unit_price' => $row["unit_price"],
            'store_location' => $row["store_location"],
            'date_added' => $row["date_added"],
            'date_edited' => $row["date_edited"],
            'id' => $row["id"]
        ];

        redirect("../");

        $conn->close();

        
    };
};

    function redirect($url) {
            header('Location: '.$url);
            die();
        }
?>



