<?php
include "connection.php";
extract($_POST);

// display data
if(isset($_POST['records'])){
    $data="";
     $data .=" <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
                <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>EDIT</th>
                <th>DELETE</th>
                </tr>
            </thead>
            <tbody>";
    
            $display = "SELECT * FROM `ajaxcrudtable`";
            $result = mysqli_query($con,$display);
            if(mysqli_num_rows($result)>0){
                $number=1;
            
                while($row = mysqli_fetch_assoc($result)) { 
                    $data .= " <tr>
                                    <td>".$number."</td>
                                    <td>".$row['name']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['password'].'</td>
                                    <td><button class="btn btn-info" onclick="editdata('.$row['id'].')">EDIT</button></td>
                                    <td><button class="btn btn-danger" onclick="deletedata('.$row['id'].')">DELETE</button></td>
                                </tr>';
                    $number++;    
                } 
                    $data .=" </tbody></table>";
                echo $data; 
            }
}

// insert data
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']))
{
    $insert = "INSERT INTO `ajaxcrudtable`( `name`, `email`, `password`) VALUES ('$name','$email','$password')";
    mysqli_query($con,$insert);
}

// delete data

if(isset($_POST['d'])){
    $deleteid = $_POST['d'];
    $deleterecord = "DELETE FROM `ajaxcrudtable` WHERE id = $deleteid";
    mysqli_query($con,$deleterecord);
}

// edit record

if(isset($_POST['e'])){
    $editid = $_POST['e'];
    $selectRecord = "SELECT * FROM `ajaxcrudtable` WHERE id = $editid";
    $sql = mysqli_query($con,$selectRecord);
    //print_r($sql);
    $response = array();
    while($result = mysqli_fetch_assoc($sql)){
    $response= $result;
}
$myJSON = json_encode($response);
echo $myJSON;
}

// update record

if(isset($_POST['idth'])&& isset($_POST['name1']) && isset($_POST['email1']) && isset($_POST['password1'])){
    $idth = $_POST['idth'];
    $name1 = $_POST['name1'];
    $email1 = $_POST['email1'];
    $password1 = $_POST['password1'];

    $update ="UPDATE `ajaxcrudtable` SET `name`='$name1',`email`='$email1',`password`='$password1' WHERE `id` = $idth";
        //echo $id;
    mysqli_query($con,$update);
}
?>
