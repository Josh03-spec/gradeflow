<?php 
session_start();
error_reporting(0);
include('includes/config.php');

// Database connection
$mysqli = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if(strlen($_SESSION['alogin']) == "") {   
    header("Location: index.php"); 
} else {
    // Code for Deletion
    if(isset($_GET['id'])) { 
        $subid = $_GET['id'];
        $sql = "DELETE FROM tblsubjects WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $subid);
        if ($stmt->execute()) {
            echo '<script>alert("Data deleted.")</script>';
            echo "<script>window.location.href ='manage-subjects.php'</script>";
        } else {
            echo '<script>alert("Error deleting data.")</script>';
        }
        $stmt->close();
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Manage Subjects</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen"> <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
    <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>
</head>
<body class="top-navbar-fixed">
    <div class="main-wrapper">
        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php');?> 
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <?php include('includes/leftbar.php');?>  

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Manage Subjects</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> Subjects</li>
                                    <li class="active">Manage Subjects</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>View Subjects Info</h5>
                                            </div>
                                        </div>
                                        <?php if($msg){?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div>
                                        <?php } else if($error){?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="panel-body p-20">
                                            <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Subject Name</th>
                                                        <th>Subject Code</th>
                                                        <th>Creation Date</th>
                                                        <th>Updation Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Subject Name</th>
                                                        <th>Subject Code</th>
                                                        <th>Creation Date</th>
                                                        <th>Updation Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php 
                                                $sql = "SELECT * FROM tblsubjects";
                                                $result = $mysqli->query($sql);
                                                $cnt = 1;
                                                if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($row['SubjectName']);?></td>
                                                            <td><?php echo htmlentities($row['SubjectCode']);?></td>
                                                            <td><?php echo htmlentities($row['Creationdate']);?></td>
                                                            <td><?php echo htmlentities($row['UpdationDate']);?></td>
                                                            <td>
                                                                <a href="edit-subject.php?subjectid=<?php echo htmlentities($row['id']);?>" class="btn btn-info btn-xs">Edit</a> 
                                                                <a href="manage-subjects.php?id=<?php echo $row['id'];?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs">Delete</a>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                        $cnt++;
                                                    } 
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>
    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/prism/prism.js"></script>
    <script src="js/DataTables/datatables.min.js"></script>
    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
        $(function($) {
            $('#example').DataTable();
            $('#example2').DataTable( {
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false
            });
            $('#example3').DataTable();
        });
    </script>
</body>
</html>
<?php 
$mysqli->close(); 
} 
?>
