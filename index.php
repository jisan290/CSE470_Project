<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signin.css">
    <title>Park & GO</title>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <?php
                if(isset($_GET['message'])) {
                    echo "<div class='message'>
                        <p>Registration Successful.</p>
                        </div>";
                }
            ?>
            <h1 class="logo-s">Park & GO</h1>
            <form action="signin.php" method="post">
                <label for="username">Username:</label>
                <br>
                <input class="textbox" type="text" name="username" required>
                <br>
                <label for="password">Password:</label>
                <br>
                <input class="textbox" type="password" name="password" reduired>
                <br>
                <?php
                    if(isset($_GET['error'])) {
                        echo "<div class='message' style='color: Red'>
                            <p>Invalid username or password</p>
                            </div> <br>";
                    } 
                    
                ?>
                <button class="button"><strong>Sign In</strong></button>
                <br>
                <a class="anchor" href="signup.php">Don't have an account? Sign up here!</a>
            </form>
        </div>
    </div>
       
</body>
</html>