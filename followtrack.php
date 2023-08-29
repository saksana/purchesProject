<?php
session_start();
if (isset($_SESSION['file_userid'])) {
if (isset($_GET['docid'])) {
    date_default_timezone_set("Asia/Bangkok");
    require 'connect.php';
    $date = date("d/m/Y");
    $docid = $_GET['docid'];
    $sql = "SELECT * FROM tbtracking WHERE docid = '$docid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $stt = $row['status'];

    $sqlstt = "SELECT * FROM tbtrackstatus WHERE docid = '$docid'";
    $resultstt = mysqli_query($con, $sqlstt);
    $rowstt = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($resultstt);

    echo $newdate = date('d/m/Y', strtotime($row['createdate']));
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Follow Track</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="style.css">
        <style>
            td {
                border-top: 1px dashed #d3d3d3;
                border-bottom: 1px dashed #d3d3d3;
                padding: 20px 10px 20px 10px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            .circle {
                color: red;
            }
        </style>
    </head>

    <body>
        <?php require 'nav.php';
        ?>
        <div style="padding-top: 45px;">
            <?php require 'menu.php' ?>
            <div id="main" class="contents">
                <div class="container">
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຕິດຕາມເອກະສານ</span></div>
                    <hr>
                    <div class="">ວັນທີສ້າງຂໍ້ມູນ : <?php echo $newdt = date("d/m/Y H:i:s", strtotime($row["createdate"])); ?><a class="btn btn-sm btn-danger p-1 px-3 float-end me-4 <?php if ($stt == 'Reject') {
                                                                                                                                                echo 'd-none';
                                                                                                                                            } ?>" data-bs-toggle="modal" data-bs-target="#myModal2">Reject</a></div>
                    <div class="mt-2">ເລກທີ : <?php echo $row['docid'] ?></div>
                    <div class="mt-2"> ຫົວຂໍ້ : <?php echo $row['title'] ?></div>
                    <div class="mt-2">ລາຍລະອຽດ : <?php echo $row['detail'] ?></div>
                    <div class="mt-2">ຜູ້ສ້າງຂໍ້ມູນ : <?php echo $row['admin'] ?></div>
                    <div class="mt-2">ສະຖານະ : <?php echo $row['status'] ?></div>
                    <div class="mt-3">

                        <a class="btn btn-sm btn-primary p-1 px-3 <?php if ($stt == 'Reject') {
                                                                        echo 'd-none';
                                                                    } ?>" data-bs-toggle="modal" data-bs-target="#myModal1">Approve</a>
                        <a class="btn btn-sm btn-warning p-1 px-3 <?php if ($stt != 'Pending') {
                                                                        echo 'd-none';
                                                                    } ?>" data-bs-toggle="modal" data-bs-target="#myModal3">ແກ້ໄຂຂໍ້ມູນ</a>
                        <a onclick="history.back()" class="btn btn-sm btn-dark p-1 px-3">ກັບຄືນ</a>
                    </div>
                    <form action="savetrackstatus.php" method="POST" class="needs-validation" novalidate>
                        <div class="modal" id="myModal1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <span class="fs-6" style="font-weight:600;">Approve File - ອານຸມັດເອກະສານ</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <input name="docid" type="text" class="form-control form-control-sm" value="<?php echo $row['docid'] ?>" placeholder="" required readonly>
                                        <label class="mx-1 mt-0 mb-1">ວັນທີ</label>
                                        <input id="dt" name="date" type="text" value="<?php echo $date ?>" class="form-control form-control-sm" placeholder="" required>
                                        <label class="mx-1 mt-2 mb-1">ຊື່ຝ່າຍ</label>
                                        <input name="namepart" type="text" class="form-control form-control-sm" placeholder="" required>
                                        <label class="mx-1 mt-2 mb-1">ຊື່ຜູ້ອານຸມັດ</label>
                                        <input name="fullname" type="text" class="form-control form-control-sm" placeholder="" required>

                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-sm btn-primary py-2" value="ອານຸມັດ" />
                                        <button type="button" class="btn btn-sm btn-danger px-3 py-2" data-bs-dismiss="modal">ປິດ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="rejecttrackstatus.php" method="POST" class="needs-validation" novalidate>
                        <div class="modal" id="myModal2">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <span class="fs-6" style="font-weight:600;">Reject File - ຍົກເລີກເອກະສານ</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <input name="docid" type="text" class="form-control form-control-sm" value="<?php echo $row['docid'] ?>" placeholder="" required readonly>
                                        <label class="mx-1 mt-0 mb-1">ວັນທີ</label>
                                        <input id="dt" name="date" type="text" value="<?php echo $date ?>" class="form-control form-control-sm" placeholder="" required>
                                        <label class="mx-1 mt-2 mb-1">ຊື່ຝ່າຍ</label>
                                        <input name="namepart" type="text" class="form-control form-control-sm" placeholder="" required>
                                        <label class="mx-1 mt-2 mb-1">ຊື່ຜູ້ຍົກເລີກ</label>
                                        <input name="fullname" type="text" class="form-control form-control-sm" placeholder="" required>
                                        <label class="mx-1 mt-2 mb-1">ລາຍລະອຽດການຍົກເລີກ</label>
                                        <textarea name="detail" rows="4" class="form-control form-control-sm" placeholder="" required></textarea>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-sm btn-danger py-2" value="ຍົກເລີກເອກະສານ" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="updatefile.php" method="POST" class="needs-validation" novalidate>
                        <div class="modal" id="myModal3">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <span class="fs-6" style="font-weight:600;">ແກ້ໄຂຂໍ້ມູນເອກະສານ</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <input name="trackid" type="text" class="form-control form-control-sm mb-2" value="<?php echo $row['trackid'] ?>" placeholder="" required readonly>
                                        <label class="mx-1 mt-0 mb-1">ວັນທີສ້າງຂໍ້ມູນ</label>
                                        <input id="dt" name="createdate" type="text" value="<?php echo $newdate ?>" class="form-control form-control-sm" placeholder="" required>
                                        <label class="mx-1 mt-2 mb-1">ຜູ້ສ້າງຂໍ້ມູນ</label>
                                        <input name="admin" type="text" class="form-control form-control-sm" placeholder="" required value="<?php echo $row['admin'] ?>">
                                        <label class="mx-1 mt-2 mb-1">ເລກທີ</label>
                                        <input name="docid" type="text" class="form-control form-control-sm" placeholder="" required value="<?php echo $row['docid'] ?>" readonly>
                                        <label class="mx-1 mt-2 mb-1">ເອກະສານກ່ຽວກັບ</label>
                                        <input name="title" type="text" class="form-control form-control-sm" placeholder="" required value="<?php echo $row['title'] ?>">
                                        <label class="mx-1 mt-2 mb-1">ລາຍລະອຽດ</label>
                                        <textarea name="detail" rows="4" class="form-control form-control-sm" placeholder="" required><?php echo $row['detail'] ?></textarea>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-sm btn-primary py-2" value="ອັບເດດຂໍ້ມູນ" />
                                        <button type="button" class="btn btn-sm btn-danger px-3 py-2" data-bs-dismiss="modal">ປິດ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <span class="px-2 fs-6" style="font-weight:600;">ການອະນຸມັດ</span>
                    <div class="mt-3">
                        <?php if ($count > 0) { ?>
                            <table>
                                <?php while ($rowstt = mysqli_fetch_assoc($resultstt)) { ?>
                                    <tr>
                                        <td>
                                            <div class="text-center">ວັນທີ</div>
                                            <div class="text-center"><?php echo $newdts = date("d/m/Y H:i:s", strtotime($rowstt['date'])); ?></div>

                                        </td>
                                        <td class="text-end circle">
                                            <i class="fa-solid fa-circle"></i>
                                        </td>
                                        <td style="border-left:1px solid #d3d3d3">
                                            <div>
                                                <div><?php echo $rowstt['namepart']; ?></div>
                                                <div><?php echo $rowstt['fullname']; ?></div>
                                                <div class="mt-1 text-primary"><span><?php echo $rowstt['status']; ?></span></div>
                                                <div><?php echo $rowstt['detail']; ?></div>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                <?php } ?>

                            </table>
                        <?php } else { ?>
                            <div class="alert alert-danger">ຍັງບໍ່ມີການອານຸມັດ</div>
                        <?php } ?>
                    </div>
                    <div style="height: 50px;">

                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            flatpickr("#dt", {
                dateFormat: "d/m/Y"
            });
        </script>
    </body>

    </html>

<?php }
} else {
    header("Location:login.php");
} ?>

