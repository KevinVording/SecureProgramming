<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<?php ob_start(); ?>
<?php session_start(); ?>

<?php
    if (isset($_SESSION['user_id']))
    {
        header("Location: groepen.php");
    }
?>

<?php

    $errors = '';
    $error_color = 'green';

    if (isset($_POST['login']))
    {
        $username = escapeString($_POST['username']);
        $password = escapeString($_POST['password']);

        $query = "SELECT * FROM sw_user WHERE user_name = '{$username}'";
        $result = mysqli_query($connection, $query);

        confirmQuery($result);

        if(escapeString(mysqli_num_rows($result)) == 0)
        {
            $errors .= 'Username and password do not match' . '<br>';
            $error_color = 'red';
        }
        else
        {
            while ($row = mysqli_fetch_array($result))
            {
                $db_id          = escapeString($row['user_id']);
                $db_username    = escapeString($row['user_name']);
                $db_password    = escapeString($row['user_password']);
                $db_firstname   = escapeString($row['user_firstname']);
                $db_lastname    = escapeString($row['user_lastname']);
                //$db_role        = escapeString($row['user_role']);
                $db_email       = escapeString($row['user_email']);
            }

            if(verifyPassword($password, $db_password) == true)
            {
                setSession($db_id, $db_username, $db_firstname, $db_lastname, $db_email);
                header("Location: groepen.php");

                $errors .= 'Correct' . '<br>';
            }
            else
            {
                $errors .= 'Username and password do not match' . '<br>';
                $error_color = 'red';
            }
        }
    }
?>

<?php include "includes/header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="padding: 15px; maring: 0 auto;">
                <!-- Blog Login Well -->
                <div class="well">
                    <h4 class="text-center">Login</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input name="login" type="submit" class="btn btn-primary btn-block" value="Log in">
                        </div>
                        <?php if($errors != ""): ?>
                        <div style='color: <?php echo $error_color; ?>' class="text-center">
                            <?php echo $errors; ?>
                        </div>
                    <?php endif; ?>
                    </form>
                    <!-- /.input-group -->
                </div>
            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>
