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
    $time = date("H:i:s");
    $date = $_POST['date'];
    $newdate =  str_replace('/', '-', $date);
    $dt = date("Y-m-d", strtotime($newdate)) . " " . $time;
    $namepart=$_POST['namepart'];
    $fullname=$_POST['fullname'];
    $status="Reject";
    $detail=$_POST['detail'];;
    $docid=$_POST['docid'];
    $sql = "INSERT INTO tbtrackstatus(date,namepart,fullname,status,detail,docid) VALUES ('$dt','$namepart','$fullname','$status','$detail','$docid')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $sqlstt= "UPDATE tbtracking SET status='$status' WHERE docid = '$docid'";
        $resultstt = mysqli_query($con,$sqlstt);
        $link_address = "followtrack.php?docid=$docid";
        echo "<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: 'success',
                    title: 'ສຳເຫຼັດ',
                    text: 'ຍົກເລີກຂໍ້ມູນແລ້ວ',
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