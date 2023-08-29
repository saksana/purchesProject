<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
<?php
date_default_timezone_set("Asia/Bangkok");
$id = date("ymdhisms");
if (isset($_POST['docid'])) {
    require 'connect.php';
    $trackid=$_POST['trackid'];
    $docid=$_POST['docid'];
    $time = date("H:i:s");
    $date = $_POST['createdate'];
    $newdate =  str_replace('/', '-', $date);
    $dt = date("Y-m-d", strtotime($newdate)) . " " . $time; 
    $createdate=$dt;

    $title=$_POST['title'];
    $detail=$_POST['detail'];
    $admin=$_POST['admin'];
    $status='Pending';
    $sql = "UPDATE tbtracking SET docid='$docid', createdate='$createdate', title='$title', detail='$detail', admin='$admin' WHERE trackid='$trackid'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $link_address = "followtrack.php?docid=$docid";
        echo "<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: 'success',
                    title: 'ສຳເຫຼັດ',
                    text: 'ອັບເດດຂໍ້ມູນແລ້ວ',
                    showConfirmButton : false,
                    timer:2000,
                    footer: '<a class=" . '"btn btn-primary"' . " href=" . "$link_address" . ">OK</a>'
                  });
            });
            </script>";
        header("refresh:2, Url=$link_address");
        exit();
    } else {
        echo mysqli_error($con);
    }
} else {
}

?>