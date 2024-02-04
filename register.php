    <?php
        $host='localhost';
        $user='root';
        $pass='';
        $db='testchallenge';
        $Uname=$_POST['uname'];
        $Phone=$_POST['phone'];
        $Password=$_POST['psw'];
        $conn=mysqli_connect($host, $user, $pass, $db);
        if(!$conn)
            {
                die('could not connect: '. mysqli_error());
            }
            echo 'connected successfully';

            $sql= "INSERT INTO register(uname,phone,psw) VALUES ('$Uname','$Phone','$Password')";
             echo "$sql";
             mysqli_query($conn,$sql);
         mysqli_close($conn);
            ?>
