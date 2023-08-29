<?php
session_start();
if (isset($_SESSION['file_userid'])) {
date_default_timezone_set("Asia/Bangkok");
require 'connect.php';

$dt = date("d/m/Y");
$fromdate =  "$dt";
if (isset($_POST['fromdate'])) {
    $fromdate = $_POST['fromdate'];
}
$todate =  "$dt";
if (isset($_POST['tdate'])) {
    $todate = $_POST['tdate'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage File</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'nav.php';
    ?>
    <div style="padding-top: 45px;">
        <div id="mySidenav" class="sidenav">
            <label style="font-family: 'Trebuchet MS';padding:10px 5px 10px 20px">Main Menu</label>
            <a class="btns" href="index.php">ສ້າງເອກະສານ</a>
            <a class="btns" href="managefile.php">ຈັດການເອກະສານ</a>
            <a class="btns active" href="adminsearchfile.php">ຄົ້ນຫາເອກະສານ</a>
            <a class="btns" href="reject.php">ເອກະສານທີ່ຍົກເລີກ</a>
        </div>
        <div id="main" class="contents">
            <div class="container">
                <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຄົ້ນຫາເອກະສານ</span></div>
                <h>
                    <div class="mt-3">
                        <form name="myForm" action="adminsearchfile.php" method="post" onsubmit="return checkform()">
                            ວັນທີ <input id="dt" name="fromdate" type="text" class="mytxt" placeholder="ວັນທີ" value="<?php echo $fromdate ?>">
                            ຫາວັນທີ <input id="dt" name="tdate" type="text" class="mytxt" placeholder="ຫາວັນທີ" value="<?php echo $todate ?>">
                            <button type='submit' class="mybtn"><i class="fa-solid fa-magnifying-glass-plus"></i> Filter</button>
                            <a href="" class="text-danger ms-1 fs-5"><i class="fa-solid fa-rotate"></i></a>
                        </form>
                    </div>
                    <hr>
                    <!---->
                    <div class="my-3" style="font-weight:600;">ຂໍ້ມູນເອກະສານ</div>
                    <?php
                    if (isset($_POST['fromdate'])) {
                        $fromdate = $_POST['fromdate'];
                        $fdate=  str_replace('/', '-', $fromdate);
                        $dtx = date("Y-m-d", strtotime($fdate));

                        $tdate = $_POST['tdate'];
                        $todate=  str_replace('/', '-', $tdate);
                        $dty= date("Y-m-d", strtotime($todate));
                        if ($fromdate == "") {
                        } else {
                            $sql = "SELECT * FROM tbtracking WHERE date(createdate) BETWEEN '$dtx' AND '$dty'";
                            $result = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count > 0) {
                    ?>
                                <div class="table-responsive-xxl">
                                    <table id="myTable" class="table table-hover" style="width:100%;">
                                        <thead>
                                            <tr style="font-weight:600;">
                                                <td>ເລກທີ</td>
                                                <td>ວັນທີສ້າງຂໍ້ມູນ</td>
                                                <td>ເອກະສານກ່ຽວກັບ</td>
                                                <td>ລາຍລະອຽດ</td>
                                                <td>ຜູ້ສ້າງຂໍ້ມູນ</td>
                                                <td>ສະຖານະ</td>
                                                <td class="text-center">ສະແດງ</td>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #e0e0e0;">
                                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                                $stt = $row["status"]; ?>

                                                <tr class="<?php if ($stt == 'Reject') {
                                                                echo 'table-danger';
                                                            } ?>">
                                                    <td>
                                                        <div style="width:180px;overflow:hidden;"><a href="followtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><?php echo $row["docid"]; ?></a></div>
                                                    </td>
                                                    <td>
                                                        <div style="width:140px;overflow:hidden;"><?php echo $newdt= date("d/m/Y H:i:s", strtotime($row["createdate"])); ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="width:220px;overflow:hidden;"><?php echo $row["title"]; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="width:250px;overflow:hidden;"><?php echo $row["detail"]; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="width:150px;overflow:hidden;"><?php echo $row["admin"]; ?></div>
                                                    </td>
                                                    <td>
                                                        <div style="width:70px;overflow:hidden;"><?php echo $row["status"]; ?></div>
                                                    </td>
                                                    <td class="text-center text-danger fs-6"><a href="followtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><i class="fa-solid fa-eye"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ບໍ່ມີຂໍ້ມູນ
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="window.location = 'managefile.php'"></button>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Something went wrong!',
                                            footer: '<a href="">Why do I have this issue?</a>'
                                        })
                                    });
                                </script>
                            <?php
                            }
                        }
                    } else {
                        $dts = date("Y-m-d");
                        $sql = "SELECT * FROM tbtracking WHERE DATE(createdate) = '$dts' ORDER BY trackid desc";
                        $result = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($result);
                        if ($count > 0) {
                            ?>

                            <div class="table-responsive-xxl">
                                <table id="myTable" class="table table-hover" style="width:100%;">
                                    <thead>
                                        <tr style="font-weight:600;">
                                            <td>ເລກທີ</td>
                                            <td>ວັນທີສ້າງຂໍ້ມູນ</td>
                                            <td>ເອກະສານກ່ຽວກັບ</td>
                                            <td>ລາຍລະອຽດ</td>
                                            <td>ຜູ້ສ້າງຂໍ້ມູນ</td>
                                            <td>ສະຖານະ</td>
                                            <td class="text-center">ສະແດງ</td>
                                        </tr>
                                    </thead>
                                    <tbody style="border: 1px solid #e0e0e0;">
                                        <?php while ($row = mysqli_fetch_assoc($result)) {
                                            $stt = $row["status"]; ?>

                                            <tr class="<?php if ($stt == 'Reject') {
                                                            echo 'table-danger';
                                                        } ?>">
                                                <td>
                                                    <div style="width:180px;overflow:hidden;"><a href="followtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><?php echo $row["docid"]; ?></a></div>
                                                </td>
                                                <td>
                                                    <div style="width:140px;overflow:hidden;"><?php echo $newdt= date("d/m/Y H:i:s", strtotime($row["createdate"])); ?></div>
                                                </td>
                                                <td>
                                                    <div style="width:220px;overflow:hidden;"><?php echo $row["title"]; ?></div>
                                                </td>
                                                <td>
                                                    <div style="width:250px;overflow:hidden;"><?php echo $row["detail"]; ?></div>
                                                </td>
                                                <td>
                                                    <div style="width:150px;overflow:hidden;"><?php echo $row["admin"]; ?></div>
                                                </td>
                                                <td>
                                                    <div style="width:70px;overflow:hidden;"><?php echo $row["status"]; ?></div>
                                                </td>
                                                <td class="text-center text-danger fs-6"><a href="followtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><i class="fa-solid fa-eye"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger">ບໍ່ມີຂໍ້ມູນເອກະສານ</div>
                    <?php
                        }
                    }
                    ?>

            </div>
        </div>
    </div>
    <hr>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[1, "asc" ]]
            });
        });
    </script>
    <script>
        flatpickr("#dt", {
            dateFormat: "d/m/Y"
        });
    </script>
    <script type="text/javascript">
        function checkform() {
            var docid = document.forms["myForm"]["docid"].value;
            if (docid === "") {

                return false;
            }
        }
    </script>
    <script>
        flatpickr("#dt", {
            dateFormat: "d/m/Y"
        });
    </script>
</body>

</html>
<?php
} else {
    header("Location:login.php");
}
?>