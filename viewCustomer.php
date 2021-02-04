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
        <title>View Customers</title>
    </head>

    <body>
    <?php 
        include 'navbar.php'
        ?>
    <?php
        include 'connection.php';
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con,$sql);
    ?>


        <h3>All Customer Apperars here</h3>
        <table>
            <?php 
                while($rows=mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $rows['accountNo'] ?></td>
                    <td><?php echo $rows['firstName'], ' ', $rows['lastName']?></td>
                    <td><?php echo $rows['email']?></td>
                    <td><?php echo $rows['balance']?></td>
                    <td><?php echo $rows['numberOfTransction']?></td>
                    <td>
                        <a href="makeTransaction.php?id=<?php echo $rows['accountNo'] ;?>"> 
                            <button type="button" class="btn">Transfer</button>
                        </a>
                    </td> 
                </tr>
            <?php
                }
            ?>
        </table>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
