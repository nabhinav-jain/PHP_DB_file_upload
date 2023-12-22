<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload in PHP</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- end bootstrap -->
</head>
<body>
    <div class="alert alert-secondary" role="alert">
        <h4 class="text-center">UPLOAD IMAGE FILE</h4>
    </div>

    <div class="container col-12 m-5">
        <div class="col-6 m-auto">
    <!-- start php code -->
        <?php

        if(isset($_POST['btn_img'])){
        $conn=mysqli_connect("localhost","root","","file_upload");
        $filename=$_FILES['userfile']['name'];
        $tempfile=$_FILES['userfile']['tmp_name'];
        $folder="image/".$filename;

        $sql="INSERT INTO `image`(`name`) VALUES('$filename')";
        if($filename == ""){
            echo " <div class='alert alert-danger' role='alert'>
            <h4 class='text-center'>Empty image</h4>
        </div> ";
        }else{
            $result=mysqli_query($conn,$sql);
            move_uploaded_file($tempfile,$folder);
            echo " <div class='alert alert-success' role='alert'>
            <h4 class='text-center'>IMAGE UPLOADED</h4>
            </div> ";


        }
    }
        ?>
        <!-- end php code -->

            <form action="index.php" method="post" class="form-control" enctype="multipart/form-data">
                <input type="file" class="form-control" id="" name="userfile">
                <div class="col-6 m-auto">
                    <button name="btn_img" type="submit" class="btn btn-outline-success m-4">
                        Submit
                    </button>
                </div>
            </form>

            <table class="table text-center">
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>button</th>
                </tr>
           <!-- php for image display -->
                <?php
                $conn=mysqli_connect("localhost","root","","file_upload");
                $sql2="SELECT * FROM `image`";
                $result2=mysqli_query($conn,$sql2);

                while($fetch=mysqli_fetch_assoc($result2)){

                    
                    ?>
               <!-- code end to seperate html and php but all php codes working together -->
                    <tr>
                        <td><?php echo $fetch['id']  ?></td>
                        <td><img src="image/<?php echo $fetch['name']  ?>" width="100px"></td>
                        <td><a href="delete.php?id=<?php echo $fetch['id'] ?>" class="btn btn-danger">Delete image</a></td>
                       
                    </tr>
                <?php

                
                }

            ?>
    <!-- php end -->
            </table>
        </div>
    </div>

</body>
</html>