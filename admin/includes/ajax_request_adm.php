<?php
session_start();
include("dbcon.php");

// check login
if($_POST["action"] == 'login'){
    function encrypt_pass($pass){
        $encript_password = md5($pass);
        return $encript_password;
   }
   $uname=$_POST["email"];
   $password=$_POST["password"];
    if($uname=="" || $password=="")
    {
        echo "it is required";
        exit();
    }
    $pass_encrypted = encrypt_pass($password);
    $sql_users = "SELECT * FROM `users` WHERE `email` = '$uname' AND `password`='$pass_encrypted' AND status=1 AND role=1";
    $res_users = mysqli_query($connection,$sql_users);
    $row_users = mysqli_fetch_array($res_users);
    //print_r(mysqli_num_rows($res_users));exit();
    if(mysqli_num_rows($res_users) > 0)
    {
        $_SESSION['logged_in']=$_POST['email'];
        $_SESSION['adminid']=$row_users['id'];
        $_SESSION['photo']=$row_users['photo'];
        $_SESSION['created_on']=$row_users['created_on'];
       $_SESSION['adminfull']=$row_users['firstname'].'-'.$row_users['lastname'];
        //echo $_SESSION['logged_in']; exit();
            if($_SESSION['logged_in'] == TRUE){
                //header('Location: ../dashboard');
                echo "loginedsuccess";
                exit();
            }    
    }else{
        echo "Please try with correct credential";
    }


}

// add record
if($_POST["action"] == 'add_emp'){
    $name=$_POST["e_name"];
    if($name=="")
    {
        echo "name is required";
        die();
    }
    $age=$_POST["e_age"];
    if($age=="")
    {
        echo "Age is required";
    }
    $salary=$_POST["e_salary"];
    $insert="INSERT INTO `employee`(`name`, `age`, `salary`) VALUES ('$name','$age','$salary')";
    mysqli_query($connection,$insert);
    //echo '<div class="text-success">Inserted Successfull';
    if(mysqli_affected_rows($connection)>0)
    {
        echo "Insert Successfull";
    }

}

// edit record
if($_POST["action"] == 'edit_emp'){
    $id=$_POST["id"];
    $sql = "SELECT * FROM `employee` WHERE `id`='$id'";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result);?>
    <div class="panel-body">
        <div class="container">
          <form>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="form_style">
                            <label>Name: </label>
                            <input type="text" placeholder="Name" class="form-control" value="<?=$row['name']?>" required id="name">
                            <label>Age: </label>
                            <input type="text" placeholder="Age" class="form-control" value="<?=$row['age']?>" required id="age">
                            <label>Salary: </label>
                            <input type="text" placeholder="Salary" class="form-control" value="<?=$row['salary']?>" required id="salary">
                        </div>
                    </div>
                </div>
            </div>
          </form>
          <a id="update_emp" class="btn btn-primary" onclick="update_emp(<?=$id; ?>);">Update</a>
        </div>
        <div id="response_msg"></div>
        <div id="error"></div>
    </div>
<?php }

// update record
if($_POST["action"] == 'update_emp'){
    $id=$_POST["id"];
    $name=$_POST["e_name"];
    if($name==""){ echo "name is required"; die();}
    $age=$_POST["e_age"];
    if($age==""){ echo "Age is required"; }
    $salary=$_POST["e_salary"];
    $sql = "UPDATE `employee` SET `name` ='$name', `age` ='$age', `salary` ='$salary'  WHERE `id` = '$id'";
    $res = mysqli_query($connection,$sql);
    if(mysqli_affected_rows($connection) > 0) {
        echo "Success";
    } else {
        echo "failure";
    }
  } 

// delete record
  if($_POST["action"] == 'delete_emp'){
    $id=$_POST["id"];
    $sql = "DELETE FROM `employee` WHERE `id` = '$id'";
    $res = mysqli_query($connection,$sql);
    if(mysqli_affected_rows($connection) > 0) {
        echo "Deleted Successfully";
    } else {
        echo "failure";
    }
  } 
?>