<?php
include("../include/session.php");

if (!isLogin()) {
    echo '<script>window.location.href = "../"</script>';
    die();
}

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Changed Password - Digital Barangay";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/";
$page_url = "https://digitalbarangay.com/change-pasword";
$directory = "../";
$directory_img = $directory;
$recaptcha = true;

include("../include/header.php");

?>


<body class="d-flex flex-column min-vh-100">
    <?php include("../include/nav.php"); ?>

    <main>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4" id="mobile">
                    <img class="rounded mx-auto d-block img-fluid" src="../images/dial122-web-banner-v2.jpg"
                        alt="Banner" width="500">
                    <img class="mt-3 mb-5 rounded mx-auto d-block img-fluid"
                        src="../images/coronavirus-safety-tw.jpg.img.jpeg" alt="Banner" width="500">
                </div>
                <div class="col-md-7">
                    <div class="container">
                        <form action="<?php htmlspecialchars('php_self'); ?>" method="post" id="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>Change Password</h1>
                                    <br>
                                    <div class="input-group2">
                                        <input type="password" placeholder="Previous Password" name="ppassword"
                                            id="ppassword" required>
                                        <i class="fa fa-backward"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input type="password" placeholder="New Password" name="password" id="password"
                                            required>
                                        <i class="fa fa-key"></i>
                                    </div>

                                    <div class="input-group2">
                                        <input type="password" placeholder="Confirm New Password" name="cpassword"
                                            id="cpassword" required>
                                        <i class="fa fa-arrows-rotate"></i>
                                    </div>

                                    <input class="form-check-input" type="checkbox" value="" id="showPassword">
                                    <label class="form-check-label" for="showPassword">
                                        Show password
                                    </label>

                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <input type="hidden" name="action" value="validate_captcha">

                                    <div class="form-group mt-2">
                                        <button id="executeCaptcha" class="btn btn-primary px-5 shadow" type="submit"
                                            name="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4" id="desktop">
                    <img class="rounded mx-auto d-block img-fluid" src="../images/dial122-web-banner-v2.jpg"
                        alt="Banner" width="500">
                    <img class="mt-3 rounded mx-auto d-block img-fluid"
                        src="../images/coronavirus-safety-tw.jpg.img.jpeg" alt="Banner" width="500">
                </div>
            </div>

        </div>
    </main>

    <?php include("../include/footer.php"); ?>
</body>

</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../vendor/autoload.php';
    $client = new GuzzleHttp\Client();
    $token = $_POST["g-recaptcha-response"];
    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret' => $captcha_secret_key,
            'response' => $token
        ]
    ]);
    $result = json_decode($response->getBody());
    if ($result->success) {
        $ppassword = $password = $cpassword = "";
        if (!isset($_POST["ppassword"])) {
            echo '<script>showToast("You need to type your previous password!")</script>';
        } else {
            $ppassword = hash("sha512", $_POST["ppassword"]);
            $user_id = $_SESSION["user_id"];
            $session_id = $_SESSION["session_id"];

            $checkID = mysqli_query($conn, "SELECT * FROM account where _id = $user_id");
            if (mysqli_num_rows($checkID) > 0) {
                while ($row = mysqli_fetch_assoc($checkID)) {

                    $db_password = $row["user_password"];
                    $db_user_email = $row["user_email"];
                    $db_user_fullname = $row["user_fullname"];

                    if (!isset($_POST["password"])) {
                        echo '<script>showToast("You need to enter your new password!")</script>';
                    } else {
                        $password = hash("sha512", $_POST["password"]);
                        if (!isset($_POST["cpassword"])) {
                            echo '<script>showToast("You need to retype your password again!")</script>';
                        } else {
                            $cpassword = hash("sha512", $_POST["cpassword"]);
                            if (strcasecmp($password, $cpassword) == 0) {
                                if (strcasecmp($db_password, $ppassword) == 0) {
                                    $setPassword = "UPDATE account SET user_password = '$password' WHERE _id = $user_id";
                                    if ($conn->query($setPassword)) {
                                        $setChangePassword = "INSERT INTO passwordchanged (date_accessed, session_id, user_id, event_type) VALUES ";
                                        $today = strtotime("now");
                                        $setChangePassword .= "($today, $session_id, $user_id, 'change-password')";
                                        if ($conn->query($setChangePassword) === TRUE) {
                                            require_once "../include/mail.php";
                                            $notifyPasswordChange = initMail('../', $db_user_email, $db_user_fullname, "Your account password has been reset.", '
                                            <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                                                <div style="margin:50px auto;width:70%;padding:20px 0">
                                                    <div style="border-bottom:1px solid #eee">
                                                        <a href="" style="font-size:1.4em;color: #2e475d;text-decoration:none;font-weight:600">Digital Barangay</a>
                                                    </div>
                                                    <p style="font-size:1.1em">Hi ' . $db_user_fullname . ',</p>
                                                    <p>You received this email to let you know that your account password has been reset. If you did not do it please contact us immediately.</p>
                                                    <p style="font-size:0.9em;">Regards,<br />Digital Barangay Security Team</p>
                                                    <hr style="border:none;border-top:1px solid #eee" />
                                                    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                                                        <p>3W2+H2Q, Mayaman</p>
                                                        <p>Diliman</p>
                                                        <p>Lungsod Quezon</p>
                                                        <p>Kalakhang Maynila</p>
                                                    </div>
                                                </div>
                                            </div>
                                            ');
                                            sendMail($notifyPasswordChange);
                                            echo '<script>showPopup("Change Password", "Successfully changed your password", "' . $directory . '", "Go Home")</script>';
                                        }
                                    }
                                } else {
                                    echo '<script>showToast("Please type again your password!")</script>';
                                }
                            } else {
                                echo '<script>showToast("Please type again your new password!")</script>';
                            }
                        }
                    }
                }
            }
        }
    } else {
        echo '<script>showToast("Seems like you failed in I am not a robot test.")</script>';
    }
}
?>