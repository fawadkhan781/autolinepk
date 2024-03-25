<?php
  session_start();
	include 'includes/conn.php';
	$conn = $pdo->open();
	if(isset($_POST['login'])){
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();

			if($row['numrows'] > 0){
				if($row['status']){
					if(password_verify($password, $row['password'])){
						if($row['type']){
							$_SESSION['admin'] = $row['id'];
							$_SESSION['email'] = $row['email'];
						}
					}
					else{
						$_SESSION['error'] = 'Incorrect Password';
					}
				}
				else{
					$_SESSION['error'] = 'Account not activated.';
				}
			}
			else{
				$_SESSION['error'] = 'Email not found';
			}
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Input login credentails first';
	}
	$pdo->close();
	//echo $_SESSION['admin'].'--'.$_SESSION['email'];
//exit();
	if($_SESSION['admin']==1 && $_SESSION['email']=='admin@admin.com'){
		header('location: dashboard');
	}else{
		header('location: /ecommerce/admin/');
  }
?>