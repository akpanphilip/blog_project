<?php
include './lib/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_pwd = $_POST['confirm_password'];

    if (
        empty($username) &&
        empty($email) &&
        empty($mobile) &&
        empty($password) &&
        empty($confirm_pwd)
    ) {
        $emptyFields = 'Fields are empty!';
    } elseif (empty($username)) {
        $emptyUsername = 'Username field is empty!';
        //Firtname and Lastname
    } elseif (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        $UnacceptedUsername = 'Username is not accepted!';
    } elseif (empty($email)) {
        $emptyEmail = 'Email field is empty!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $UnacceptedEmail = 'Invalid Email';
    } elseif (empty($mobile)) {
        $emptyMobile = 'MMobile field is empty!';
    } elseif ($gender === 'Gender') {
        $emptyGender = 'Please select a gender';
    } elseif (empty($password)) {
        $emptyPassword = 'Password field is empty!';
    } elseif ($password !== $confirm_pwd) {
        $UnmatchedPwd = 'password does not match!';
    } else {
        // INSERT SELECT DELETE UPDATE
        $sql =
            'INSERT INTO users (username, email, mobile, gender, password) VALUES(?,?,?,?,?);';
        // initialize connection
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param(
            $stmt,
            'sssss',
            $username,
            $email,
            $mobile,
            $gender,
            $hashedPwd
        );
        if (mysqli_stmt_execute($stmt)) {
            $registeredSuccessfully = 'Successfully registered!';
            // $stmt->close;
        }
        $failedReg = 'Error in registration!';
    }

    // else{
    //     echo 'All good!';
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/form.css">
    <title>Register</title>
</head>
<body>
    <div class="register-form">
        <form action="" method="POST">          
       
        <?php if (!empty($emptyFields)): ?>
            <div class="alert alert-danger">
                <?= $emptyFields ?>
            </div> 
        <?php elseif (!empty($emptyUsername)): ?>
            <div class="alert alert-danger">
                <?= $emptyUsername ?>
            </div>
        <?php elseif (!empty($emptyEmail)): ?>
            <div class="alert alert-danger">
                <?= $emptyEmail ?>
            </div>
        <?php elseif (!empty($emptyMobile)): ?>
            <div class="alert alert-danger">
                <?= $emptyMobile ?>
            </div>
        <?php elseif (!empty($emptyPassword)): ?>
            <div class="alert alert-danger">
                <?= $emptyPassword ?>
            </div>
        <?php elseif (!empty($emptyGender)): ?>
            <div class="alert alert-danger">
                <?= $emptyGender ?>
            </div>
        <?php elseif (!empty($UnmatchedPwd)): ?>
            <div class="alert alert-danger">
                <?= $UnmatchedPwd ?>
            </div>
        <?php elseif (!empty($registeredSuccessfully)): ?>
            <div class="alert alert-success">
                <?= $registeredSuccessfully ?>
            </div>
        <?php elseif (!empty($UnacceptedUsername)): ?>
            <div class="alert alert-danger">
            <?= $UnacceptedUsername ?>
       </div>
       <?php elseif (!empty($UnacceptedEmail)): ?>
        <div class="alert alert-danger">
            <?= $UnacceptedEmail ?>
        </div>
        <?php endif; ?> 
         
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php $username; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" placeholder="Enter mobile">
            </div>
            <div class="form-group">
                <select name="gender" class="form-control">
                    <option class="form-control" value="Gender">Gender</option>
                    <option class="form-control" value="Male">Male</option>
                    <option class="form-control" value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-dark" value="Register">
            </div>
        </form>
    </div>
</body>

</html>