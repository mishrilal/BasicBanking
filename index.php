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
        <title>Basic Banking</title>
    </head>

    <body>
        <?php 
            include 'navbar.php'
        ?>
        <div class="container">
            <h2>Welcome to GRIP Bank</h2>
                <div class="col-sm-12 col-md img text-center">
                <img src="images/logo.svg" alt="" width="400" height="300" class="d-inline-block align-top">
                </div>
            <br>
            <div class="buttonPosition">
                <a href="viewCustomer.php"><button class="btn btn-dark btn-outline-warning mr-3">View All Customer</button></a>
                <a href="transferMoney.php"><button class="btn btn-dark btn-outline-warning mr-3">Transfer Money</button></a>
                <a href="transactionHistory.php"><button class="btn btn-dark btn-outline-warning">Transaction History</button></a>
            </div>
        </div>
        <div class="fixed-bottom">
            <?php
                include "footer.php"
            ?>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
