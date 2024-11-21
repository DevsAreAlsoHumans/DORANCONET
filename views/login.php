<!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="color-scheme" content="light dark" />
    <title>Connection</title>
    <link rel="stylesheet" href="../public/assets/css/login.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
  </head>

  <body>
    <header>
      <img src="../public/assets/img/doranco_image.png" alt="logo doranco" />
    </header>
    <main>

      <form action="" method="post">

        <div>
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
          <small>
            <?php #handle email error 
            ?>
            <p>error</p>
          </small>
        </div>
        <div>
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password">
          <small>
            <?php #handle password error 
            ?>
          </small>
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']?>">
        
        <button type="submit">Se Connecter</button>
      </form>
    </main>
  </body>

  </html>
