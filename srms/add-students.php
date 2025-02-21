<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $studentname = $_POST['fullanme'];
        $roolid = $_POST['rollid'];
        $studentemail = $_POST['emailid'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $dob = $_POST['dob'];
        $status = 1;

        $sql = "INSERT INTO tblstudents(StudentName, RollId, StudentEmail, Gender, ClassId, DOB, Status) VALUES ('$studentname', '$roolid', '$studentemail', '$gender', '$classid', '$dob', '$status')";

        if (mysqli_query($dbh, $sql)) {
            $msg = "Student info added successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Admin | Student Admission</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/prism/prism.css" media="screen">
        <link rel="stylesheet" href="css/select2/select2.min.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('includes/topbar.php'); ?>
            <div class="content-wrapper">
                <div class="content-container">
                    <?php include('includes/leftbar.php'); ?>
                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Admission</h2>
                                </div>
                            </div>
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li class="active">Student Admission</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Fill the Student info</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" method="post">
                                                <!-- Student Name -->
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Full Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="fullanme" class="form-control" id="fullanme" required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <!-- Roll Id -->
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Roll Id</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="rollid" class="form-control" id="rollid" maxlength="5" required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <!-- Email ID -->
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Email ID</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="emailid" class="form-control" id="email" required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <!-- Gender -->
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Gender</label>
                                                    <div class="col-sm-10">
                                                        <input type="radio" name="gender" value="Male" required="required" checked="">Male
                                                        <input type="radio" name="gender" value="Female" required="required">Female
                                                        <input type="radio" name="gender" value="Other" required="required">Other
                                                    </div>
                                                </div>

                                                <!-- Class Selection -->
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Class</label>
                                                    <div class="col-sm-10">
                                                        <select name="class" class="form-control" id="default" required="required">
                                                            <option value="">Select Class</option>
                                                            <?php
                                                            $sql = "SELECT * FROM tblclasses";
                                                            $result = mysqli_query($dbh, $sql);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['id'] . "'>" . $row['ClassName'] . " Section-" . $row['Section'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Date of Birth -->
                                                <div class="form-group">
                                                    <label for="date" class="col-sm-2 control-label">DOB</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="dob" class="form-control" id="date">
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="js/jquery/jquery-2.2.4.min.js"></script>
                <script src="js/bootstrap/bootstrap.min.js"></script>
                <script src="js/pace/pace.min.js"></script>
                <script src="js/lobipanel/lobipanel.min.js"></script>
                <script src="js/iscroll/iscroll.js"></script>
                <script src="js/prism/prism.js"></script>
                <script src="js/select2/select2.min.js"></script>
                <script src="js/main.js"></script>
                <script>
                    $(function($) {
                        $(".js-states").select2();
                        $(".js-states-limit").select2({
                            maximumSelectionLength: 2
                        });
                        $(".js-states-hide").select2({
                            minimumResultsForSearch: Infinity
                        });
                    });
                </script>
    </body>

    </html>
<?php } ?>