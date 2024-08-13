<?php
// Report the errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the core file
include_once(__DIR__ . "/Settings/core.php");

// Include the general functions
include_once(__DIR__ . "/Functions/general_function.php");

// If user is not logged in, redirect to the login page
if (!logged_in()) {
    header("Location: login.php");
}

// Get the user details
$user_details = get_user_details($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Account</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="assets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="assets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="assets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">

</head>

<body class="layout-default">
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->
        <?php include 'Components/header.php'; ?>
        <!-- // END Header -->

        <div>
            <p></br></br></p>
        </div>

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">

                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex align-items-center justify-content-between">

                            <h1 class="m-0">Edit Account</h1>
                        </div>
                    </div>
                    <div class="container-fluid page__container">
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-4 card-body">
                                    <p><strong class="headings-color">Basic Information</strong></p>
                                    <p class="text-muted mb-0">Edit your account details and settings.</p>
                                </div>
                                <div class="col-lg-8 card-form__body card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="fname">First name</label>
                                                <input id="fname" type="text" class="form-control" placeholder="First name" value="<?php echo $user_details['first_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lname">Last name</label>
                                                <input id="lname" type="text" class="form-control" placeholder="Last name" value="<?php echo $user_details['last_name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-4 card-body">
                                    <p><strong class="headings-color">Update Your Password</strong></p>
                                    <p class="text-muted mb-0">Change your password.</p>
                                </div>
                                <div class="col-lg-8 card-form__body card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="opass">Old Password</label>
                                                <input id="opass" name="opass" type="password" class="form-control" placeholder="Old password">
                                            </div>
                                            <div class="form-group">
                                                <label for="npass">New Password</label>
                                                <input id="npass" name="npass" type="password" class="form-control is-invalid">
                                                <small class="invalid-feedback">The new password must not be empty.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="cpass">Confirm Password</label>
                                                <input id="cpass" name="npass type="password" class="form-control" placeholder="Confirm password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right mb-5">
                            <a href="#" class="btn btn-success">Save</a>
                        </div>
                    </div>


                </div>
                <!-- // END drawer-layout__content -->

                <?php include 'Components/sidebar.php'; ?>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->


    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'student-edit-account.html',
      'fixed': 'fixed-student-edit-account.html',
      'fluid': 'fluid-student-edit-account.html',
      'mini': 'mini-student-edit-account.html'
    }"></app-settings>
    </div>

    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="assets/vendor/ion.rangeSlider.min.js"></script>
    <script src="assets/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>
</body>
</html>