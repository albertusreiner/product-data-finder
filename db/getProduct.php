<?php 
    session_start();
    include "./dbConnect.php"
    
?>

<?php
// Assuming form method is POST and inputs are named 'barcode' or 'name'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiers = $_POST['barcode'] ; // Use barcode if available, otherwise name
    $identifiers2 = $_POST['productName'];
    $sql = "SELECT * FROM products WHERE barcode = '$identifiers' OR names = '$identifiers2'";
    $result = $conn->query($sql);

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
    } else {
        $productArray = [
            'barcode' => $_POST['barcode'],
            'names' => $_POST['productName'],
        ]; // Set to null if no match is found
        $conn->close();
        redirect("../add.php");
    }
}




function redirect($url) {
    header('Location: '.$url);
    die();
}

?>
