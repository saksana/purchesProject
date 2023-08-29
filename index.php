<?php
session_start();
if (isset($_SESSION['file_userid'])) {
    date_default_timezone_set("Asia/Bangkok");
    require 'connect.php';
    $date = date("d/m/Y");
    $sql = "SELECT * FROM tbtracking ORDER BY trackid desc LIMIT 100";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create File</title>
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
                <a class="btns active" href="index.php">ສ້າງເອກະສານ</a>
                <a class="btns" href="managefile.php">ຈັດການເອກະສານ</a>
                <a class="btns" href="adminsearchfile.php">ຄົ້ນຫາເອກະສານ</a>
                <a class="btns" href="reject.php">ເອກະສານທີ່ຍົກເລີກ</a>
            </div>

            <div id="main" class="contents">
                <div class="container">
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ສ້າງເອກະສານ</span></div>
                    <h>
                        <a class="btn btn-primary btn-sm px-3 py-1 mt-3" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-circle-plus"></i> ສ້າງໃໝ່</a>
                        <form action="savefile.php" method="POST" class="needs-validation" novalidate>
                            <div class="modal" id="myModal">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <span class="fs-6" style="font-weight:600;">ຂໍ້ມູນເອກະສານ</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <label class="mx-1 mt-0 mb-1">ວັນທີສ້າງຂໍ້ມູນ</label>
                                            <input id="dt" name="createdate" type="text" value="<?php echo $date ?>" class="form-control form-control-sm" placeholder="" required>
                                            <label class="mx-1 mt-2 mb-1">ຜູ້ສ້າງຂໍ້ມູນ</label>
                                            <input name="admin" type="text" class="form-control form-control-sm" placeholder="" required value="<?php echo $_SESSION['fullname'] ?>" readonly>
                                            <label class="mx-1 mt-2 mb-1">ເລກທີ</label>
                                            <input name="docid" type="text" class="form-control form-control-sm" placeholder="" required>
                                            <label class="mx-1 mt-2 mb-1">ເອກະສານກ່ຽວກັບ</label>
                                            <input name="title" type="text" class="form-control form-control-sm" placeholder="" required>
                                            <label class="mx-1 mt-2 mb-1">ລາຍລະອຽດ</label>
                                            <textarea name="detail" rows="4" class="form-control form-control-sm" placeholder="" required></textarea>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-sm btn-primary py-2" value="ບັນທຶກຂໍ້ມູນ" />
                                            <button type="button" class="btn btn-sm btn-danger px-3 py-2" data-bs-dismiss="modal">ປິດ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <!---->
                        <div class="my-3" style="font-weight:600;">ຂໍ້ມູນເອກະສານທີ່ສ້າງລ່າສຸດ</div>
                    <?php if ($row > 0) { ?>
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
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid #e0e0e0;">
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td>
                                                <div style="width:180px;overflow:hidden;"><a href="followtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><?php echo $row["docid"]; ?></a></div>
                                            </td>
                                            <td>
                                            
                                                <div style="width:140px;overflow:hidden;"><?php echo $newDate = date("d/m/Y H:i:s", strtotime($row["createdate"])); ?></div>
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
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger">ຍັງບໍ່ມີຂໍ້ມູນ</div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "order": [
                        [1, "desc"]
                    ]
                });
            });
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
    header("Location:userhome.php");
}
?>