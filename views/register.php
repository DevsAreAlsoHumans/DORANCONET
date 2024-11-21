<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="..\public\assets\css\register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <?php
    if (session_id() == '') {
        session_start();
    }
    ?>


    <div id="form">
    <img src="..\images\Doranco.png" alt="">

    <h2>Register</h2>
    
    <form action="traiteInscription" method="post">


        <label for="name">First Name&nbsp;:</label>
        <input type="text" id="name" name="first_name" placeholder="First Name"  />

        <label for="lastName">Last Name&nbsp;:</label>
        <input type="text" id="lastName" name="last_name" placeholder="Last Name"  /><br>

        <label for="start">Birthday</label>
        <input type="date" id="start" name="trip-start" value="date_of_birth" />

        <label for="email">Email&nbsp;:</label>
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>"><br>

        <label for="password">Password&nbsp;:</label>
        <input type="password" name="password" placeholder="Password" ><br>

       
        <input class="inputfile" style="width:390px;" id="image" name="profile_picture" type="file" tabindex="6" accept="image/*"><br><br><br>

        <input type="hidden" name="csrf_token" value="<?php echo isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : "" ?>">
        <input type="submit" value="Login">
        </form>  
</div> 

</body>
</html>