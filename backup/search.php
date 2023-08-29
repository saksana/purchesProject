<?php
                    if (isset($_POST['fromdate'])) {
                        $fromdate = $_POST['fromdate'];
                        $tdate = $_POST['tdate'];
                        if ($fromdate == "") {
                        } else {
                            $sql = "SELECT * FROM tbtracking WHERE date(createdate) BETWEEN '$fromdate' AND '$tdate'";
                            $result = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count > 0) {
                    ?>
                                <div class="table-responsive-xxl">
                                    <table id="" class="table table-hover" style="width:100%;">
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
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                                $stt = $row["status"]; ?>

                                                <tr class="<?php if ($stt == 'Reject') {
                                                                echo 'table-danger';
                                                            } ?>">
                                                    <td>
                                                        <div style="width:180px;overflow:hidden;"><a href="userfollowtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><?php echo $row["docid"]; ?></a></div>
                                                    </td>
                                                    <td>
                                                        <div style="width:140px;overflow:hidden;"><?php echo $row["createdate"]; ?></div>
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
                                                    <td class="text-center text-danger fs-6"><a href="userfollowtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><i class="fa-solid fa-eye"></i></a></td>
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
                        $sql = "SELECT * FROM tbtracking WHERE DATE(createdate) = '$dt' ORDER BY trackid desc";
                        $result = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($result);
                        if ($count > 0) {
                            ?>

                            <div class="table-responsive-xxl">
                                <table id="" class="table">
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
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) {
                                            $stt = $row["status"]; ?>

                                            <tr class="<?php if ($stt == 'Reject') {
                                                            echo 'table-danger';
                                                        } ?>">
                                                <td>
                                                    <div style="width:180px;overflow:hidden;"><a href="userfollowtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><?php echo $row["docid"]; ?></a></div>
                                                </td>
                                                <td>
                                                    <div style="width:140px;overflow:hidden;"><?php echo $row["createdate"]; ?></div>
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
                                                <td class="text-center text-danger fs-6"><a href="userfollowtrack.php?docid=<?php echo $row['docid']; ?>" class="text-primary"><i class="fa-solid fa-eye"></i></a></td>
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
