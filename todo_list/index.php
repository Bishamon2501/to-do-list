<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/todo_list.js"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>To-do-List</title>
</head>

<body>
    <?php
    include_once "./config/db_connect.php";

    if (isset($_GET["err"])) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?php
            switch ($_GET["err"]) {
                case "email":
                    echo "Please enter a valid email address.";
                    break;
                case "pw":
                    echo "The passwords must match.";
                    break;
                case "taken":
                    echo "The user name or email is already taken.";
                    break;
                case "login":
                    echo "Login has failed.";
                    break;
            }
            ?>
        </div>
    <?php
    }
    if (!isset($_SESSION['userId'])) {
    ?>
        <div class="container">
            <h1>To-do-List by Bishamon</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
        </div>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login to To-do-List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="./actions/login.php" method="post" id="loginForm">
                            <label for="loginName">Username:</label>
                            <input type="text" name="loginName" id="loginName" placeholder="Username or email" required>
                            <label for="loginPassword">Password:</label>
                            <input type="password" name="loginPassword" id="loginPassword" required>
                            <div class="btn-container">
                                <input type="submit" class="btn btn-primary" name="loginBtn" value="Confirm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register for To-do-List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="./actions/register.php" method="post" id="registerForm">
                            <label for="registerUsername">Username:</label>
                            <input type="text" name="registerUsername" id="registerUsername" required>
                            <label for="registerEmail">Email</label>
                            <input type="email" name="registerEmail" id="registerEmail" required>
                            <label for="registerPassword">Password:</label>
                            <input type="password" name="registerPassword" id="registerPassword" required>
                            <label for="repeatRPassword">Repeat password:</label>
                            <input type="password" name="repeatRPassword" id="repeatRPassword" required>
                            <div class="btn-container">
                                <input type="submit" class="btn btn-primary" name="registerBtn" value="Confirm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        include_once "./todo_list.php";
    ?>
    <div class="logout-btn-container">
        <input type="submit" class="btn btn-primary" name="logoutBtn" id="logoutBtn" value="Logout">
    </div>
    <?php } ?>
</body>

</html>