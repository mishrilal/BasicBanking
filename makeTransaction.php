<?php 
    include 'connection.php';

    if(isset($_POST['submit'])) {
        $from = $_GET['accountNo'];
        $to = $_POST['to'];
        $amount = $_POST['amount'];

        $sql = "select * from users where id=$from";
        $query = mysqli_query($con, $sql);
        $sql1 = mysqli_fetch_array($query);

        $sql = "select * from users where id=$to";
        $query = mysqli_query($con, $sql);
        $sql2 = mysqli_fetch_array($query);

        if($amount < 0) {
            echo '<script type="text/javascript">';
            echo ' alert("Invalid amount")';
            echo '</script>';
        }
        else if($amount == 0) {
            echo "<script type='text/javascript'>";
            echo "alert('Zero value cannot be transferred')";
            echo "</script>";
        }
        else {
            $newbalance = $sql1['balance'] - $amount;
            $sql = "update users ser balance=$newbalance where id=$to";
            mysqli_query($con, $sql);

            $newbalance = $sql2['balance'] + $amount;
            $sql = "update users set balance=$newbalance where id=$to";
            mysqli_query($con, $sql);

            $sender = $sql1['accountNo'];
            $reciver = $sql2['accountNo'];
            $sql = "insert into transcations(`sender`,`reciver`, `balance`) value 
                ('$sender', '$receiver', '$amount')";
            $query=mysqli_query($con, $sql);

            if($query) {
                echo "<script>
                        alert('Transcation Successful');
                        window.loaction='transcationHistory.php';
                     </script>";
            }

            $newbalance = 0;
            $amount = 0;

        }

    }
?>



<!doctype html>
<html>
    <head>
         <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        <title>Transfer Money</title>
    </head>

    <body>
        <h3>transfermoney</h3>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
