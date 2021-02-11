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
        <title>Transcation History</title>
    </head>

    <body>
        <?php 
            include 'navbar.php'
            ?>
        <?php
            include 'connection.php';
            $sql = "SELECT * FROM transcations";
            $result = mysqli_query($con,$sql);
        ?>

        <div class="container">
            <h2>Transaction History</h2>
            <table class = "table table-dark table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transcation ID</th>
                        <th>Account From</th>
                        <th>Account To</th>
                        <th>Amount</th>
                        <th>Date of Transcation</th>
                    </tr>
                </thead>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td><?php echo $rows['id'] ?></td>
                        <td><?php echo $rows['transcationID']?></td>
                        <td>
                            <?php echo $rows['accountFrom']?><br>
                            (<?php echo $rows['nameFrom']?>)
                        </td>
                        <td>
                            <?php echo $rows['accountTo']?><br>
                            (<?php echo $rows['nameTo']?>)
                        </td>
                        <td><?php echo $rows['amount']?></td>
                        <td><?php echo $rows['date']?></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
        <?php
            include "footer.php"
        ?>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
