    <?php
        $host='localhost';
        $user='root';
        $pass='';
        $db='testchallenge';
        $Fullname=$_POST['fname'];
        $Email=$_POST['email'];
        $Subject=$_POST['subject'];
        $Message=$_POST['message'];
        $conn=mysqli_connect($host, $user, $pass, $db);
        if(!$conn)
            {
                die('could not connect: '. mysqli_error());
            }
            echo 'connected successfully';

            $sql= "INSERT INTO contactus(fname,email,subject,message) VALUES ('$Fullname','$Email','$Subject','$Message')";
             echo "$sql";
             mysqli_query($conn,$sql);
            mysqli_close($conn);
            ?>
