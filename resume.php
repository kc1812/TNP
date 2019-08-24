<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in()){
    login_error_redirect();
}
$email = $_SESSION['stud'];
if(isset($_POST['submit'])){
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('pdf','docx','doc');
        if(in_array($fileActualExt, $allowed)){
            if ($fileError === 0 ) {
                if ($fileSize < 6000000) {
                    $fileNameNew = $_SESSION['stud']."_resume.".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $qryUpload = $db->query("UPDATE student SET resume = '$fileNameNew' WHERE email = '$email' ");
                    header("Location: resume.php",true,301);exit;
                }else{
                    echo "File size is greater than 5MB";
                } 
            }else{
                echo "Error in uploading file. Please try again!";
            }
        }else{
            echo "This type of file is not allowed. Please try again!";
        }
}
include 'includes/header.php';
include 'includes/sidebar.php';
$sqlCheck = $db->query("SELECT * FROM student WHERE email = '$email' ");
$student = mysqli_fetch_assoc($sqlCheck);
?>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Welcome</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                       
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <?php if(strcmp($student['resume'],"no")) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card"> 
                            <div class="header">
                                <h4 class="title">Current Resume</h4>
                            </div>
                            <div class="content">
                                
                                    <!-- <label>Upload latest resume</label> -->
                                    <?php 
                                    $path = 'uploads/'.$student['resume'];
                                    ?>
                                    <a href="<?=$path; ?>" download><button class="btn btn-info btn-fill" name="submit">Download Resume</button>
                                    </a>
                                
                            </div>
                        </div>
                    </div>
               </div>
                <?php endif; ?>
               <div class="row">
                    <div class="col-md-12">
                        <div class="card"> 
                            <div class="header">
                                <h4 class="title">Upload Resume</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="resume.php" enctype="multipart/form-data">
                                    <!-- <label>Upload latest resume</label> -->
                                    <input type="file" name="file"><br>
                                    <button type="submit" class="btn btn-info btn-fill" name="submit">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>

               </div>
            </div>
        </div>
<?php
include 'includes/footer.php';
?>     