<?php 
    include 'connection.php';

    if(isset($_POST['submit'])) {
        $from = $_GET['id'];
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
            $to = $sql2['accountNo'];
            $sql = "INSERT INTO `transcations`(`transcationID`, `accountFrom`, `accountTo`, `amount`) VALUES ($tranId, $from, $to, $amount)";
            $query=mysqli_query($con, $sql);


            if($query) {
                echo "<script>
                        alert('Transcation Successful');
                        window.location ='transactionHistory.php';
                     </script>";
            }
            else {
                echo "<script>
                        alert('Something went Wrong, Try again later, $sql');
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
    <?php 
        include 'navbar.php'
        ?>
        <h3>transfermoney</h3>
        <div class="container">
        <h2 class="text-center pt-4">Transaction</h2>
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where accountNo=$sid";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($con);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">AccountNo</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['accountNo'] ?></td>
                    <td class="py-2"><?php echo $rows['firstName'], ' ', $rows['lastname'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where accountNo!=$sid";
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
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
        </form>
    </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
