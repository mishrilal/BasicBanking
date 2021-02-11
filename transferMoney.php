<?php 
    include 'connection.php';

    if(isset($_POST['submit'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $amount = $_POST['amount'];

        $sql = "select * from users where accountNo=$from";
        $query = mysqli_query($con, $sql);
        $sql1 = mysqli_fetch_array($query);

        $sql = "select * from users where accountNo=$to";
        $query = mysqli_query($con, $sql);
        $sql2 = mysqli_fetch_array($query);

        if($amount < 0) {
            echo '<script type="text/javascript">';
            echo ' alert("Invalid amount")';
            echo '</script>';
        }
        else if($amount > $sql1['balance']) {
            echo '<script type="text/javascript">';
            echo ' alert("Insufficient Balance")';
            echo '</script>';
        }
        else if($amount == 0) {
            echo "<script type='text/javascript'>";
            echo "alert('Zero value cannot be transferred')";
            echo "</script>";
        }
        else {
            $newbalance = $sql1['balance'] - $amount;
            $sql = "update users set balance=$newbalance where accountNo=$from";
            mysqli_query($con, $sql);

            $newbalance = $sql2['balance'] + $amount;
            $sql = "update users set balance=$newbalance where accountNo=$to";
            mysqli_query($con, $sql);
            
            $tranId = rand(10000, 99999);
            $dt = date('d/m/Y h:i:s');
            $from = $sql1['accountNo'];
            $nFrom = $sql1['firstName'] . ' ' . $sql1['lastName'];

            $to = $sql2['accountNo'];
            $nTo = $sql2['firstName'] . ' '  . $sql2['lastName'];
            $sql = "INSERT INTO `transcations` (`transcationID`, `accountFrom`, `accountTo`, `amount`, `nameFrom`, `nameTo`) VALUES ($tranId, $from, $to, $amount, '$nFrom', '$nTo')";
            $query=mysqli_query($con, $sql);


            if($query) {
                echo "<script>
                        alert('Transcation Successful');
                     </script>";
            }
            else {
                echo "<script>
                        alert('Something went Wrong, Try again later');
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
        <title>Direct Money Transfer</title>
    </head>

    <body>
    <?php 
        include 'navbar.php'
        ?>
        <div class="container">
            <h2>Direct Money Transfer</h2>
                <?php
                    include 'connection.php';
                    $sql = "SELECT * FROM  users";
                    $result=mysqli_query($con,$sql);
                    if(!$result)
                    {
                        echo "Error : ".$sql."<br>".mysqli_error($con);
                    }
                    $rows=mysqli_fetch_assoc($result);
                ?>
                <form method="post" name="tcredit" class="tabletext" ><br>
            <div>
                <!-- <table class="table table-dark table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">AccountNo</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Balance</th>
                        </tr>
                    </thead>
                    <tr class = "text-center">
                        <td class="py-2"><?php echo $rows['accountNo'] ?></td>
                        <td class="py-2"><?php echo $rows['firstName'], ' ', $rows['lastname'] ?></td>
                        <td class="py-2"><?php echo $rows['email'] ?></td>
                        <td class="py-2"><?php echo $rows['balance'] ?></td>
                    </tr>
                </table> -->
                <label class = "text-light">Transfer From:</label>
                <select name="from" class="form-control" required>
                <option value="" disabled selected>Choose</option>
                <?php
                    include 'connection.php';
                    $sql = "SELECT * FROM users";
                    $result=mysqli_query($con,$sql);
                    if(!$result)
                    {
                        echo "Error ".$sql."<br>".mysqli_error($con);
                    }
                    while($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <option class="table" value="<?php echo $rows['accountNo'];?>" >
                    
                        <?php echo $rows['firstName'], ' ', $rows['lastName'] ;?> (Account No.: 
                            <?php echo $rows['accountNo']; ?> Balance:
                            <?php echo $rows['balance'] ;?>) 
                
                    </option>
                <?php 
                    } 
                ?>
                <div>
            </select>
            </div>
            <br><br><br>
            <label class = "text-light">Transfer To:</label>
            <select name="to" class="form-control" required>
                <option value="" disabled selected>Choose</option>
                <?php
                    include 'connection.php';
                    $sql = "SELECT * FROM users";
                    $result=mysqli_query($con,$sql);
                    if(!$result)
                    {
                        echo "Error ".$sql."<br>".mysqli_error($con);
                    }
                    while($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <option class="table" value="<?php echo $rows['accountNo'];?>" >
                    
                        <?php echo $rows['firstName'], ' ', $rows['lastName'] ;?> (Account No.: 
                            <?php echo $rows['accountNo']; ?> Balance:
                            <?php echo $rows['balance'] ;?>) 
                
                    </option>
                <?php 
                    } 
                ?>
                <div>
            </select>
            <br>
            <br>
                <label class = "text-light">Amount:</label>
                <input type="decimal" class="form-control" name="amount" placeholder = "50000.50" required>   
                <br><br>
                    <div class="text-center" >
                <button class="btn btn-dark btn-outline-success mt-3 px-4" name="submit" type="submit" id="myBtn">Transfer</button>
                </div>
            </form>
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
