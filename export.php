<?php
require 'connect.php';
$filename = "Export" . date("ymdHis");
if (isset($_GET['docid'])) {
    $docid = $_GET['docid'];
    $sql = "SELECT * FROM tbtracking WHERE docid LIKE '%$docid%' OR title LIKE '%$docid%' OR detail LIKE '%$docid%' ORDER BY trackid desc LIMIT 100";
    $result = mysqli_query($con, $sql);
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
?>
    <div style="font-family:'Phetsarath OT'">
        <a>EXPORT EXCEL</a>
        <table>
            <thead>
                <tr>
                    <td>ເລກທີ</td>
                    <td>ວັນທີສ້າງຂໍ້ມູນ</td>
                    <td>ເອກະສານກ່ຽວກັບ</td>
                    <td>ລາຍລະອຽດ</td>
                    <td>ຜູ້ສ້າງຂໍ້ມູນ</td>
                    <td>ສະຖານະ</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <?php echo $row["docid"]; ?>
                        </td>
                        <td>
                            <?php echo $row["createdate"]; ?>
                        </td>
                        <td>
                            <?php echo $row["title"]; ?>
                        </td>
                        <td>
                            <?php echo $row["detail"]; ?>
                        </td>
                        <td>
                            <?php echo $row["admin"]; ?>
                        </td>
                        <td>
                            <?php echo $row["status"]; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    $sql = "SELECT * FROM tbtracking";
    $result = mysqli_query($con, $sql);
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
?>
    <div style="font-family:'Phetsarath OT'">
        <a>EXPORT EXCEL</a>
        <table>
            <thead>
                <tr>
                    <td>ເລກທີ</td>
                    <td>ວັນທີສ້າງຂໍ້ມູນ</td>
                    <td>ເອກະສານກ່ຽວກັບ</td>
                    <td>ລາຍລະອຽດ</td>
                    <td>ຜູ້ສ້າງຂໍ້ມູນ</td>
                    <td>ສະຖານະ</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <?php echo $row["docid"]; ?>
                        </td>
                        <td>
                            <?php echo $row["createdate"]; ?>
                        </td>
                        <td>
                            <?php echo $row["title"]; ?>
                        </td>
                        <td>
                            <?php echo $row["detail"]; ?>
                        </td>
                        <td>
                            <?php echo $row["admin"]; ?>
                        </td>
                        <td>
                            <?php echo $row["status"]; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
}
?>