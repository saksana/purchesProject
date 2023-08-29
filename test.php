<?php
if (isset($_GET['act'])) {
    if ($_GET['act'] == 'excel') {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=export.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
?>
        <table>
            <thead>
                <tr class="info">
                    <th>data1</th>
                    <th>data2</th>
                    <th>data3</th>
                    <th>date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>19-09-2019</td>
                </tr>
                <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>19-09-2019</td>
                </tr>
                <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>19-09-2019</td>
                </tr>
                <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>19-09-2019</td>
                </tr>
            </tbody>
        </table>
<?php

    }
}
?>
    <a href="?act=excel"> Export to Excel </a>

