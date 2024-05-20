<?php
session_start();

if (isset($_SESSION["logged"])) {
  header("Location: index.php");
  die;
}

require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $password = md5($password);

  $sql = "SELECT 1 FROM utenti WHERE username LIKE '$username' AND password LIKE '$password'";
  $res = conn->query($sql);

  if ($res->num_rows > 0) {
    $_SESSION["logged"] = true;
    header("Location: index.php");
    die;
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
  <title>Login</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">AWS Project</a>
    </div>
  </nav>

  <section class="vh-100">
    <div class="container py-5 w-100 h-100 position-absolute top-50 start-50 translate-middle">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-sm-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card" style="border-radius: 1rem;">
              <div class="col-sm-10 col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="" method="POST">
                    <h3 class="fw-normal mb-3 pb-3 text-left" style="letter-spacing: 1px;">Login</h3>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" id="username" name="username" class="form-control form-control-lg" maxlength="50" required />
                      <label class="form-label" for="username">Username</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                      <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="pt-1 mb-4">
                      <button type="submit" class="btn btn-light btn-lg btn-block">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer style="margin-top:5rem;">
        <div class='container'>
            <p>&copy; Nicolò Fiore</p>
        </div>
    </footer>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>