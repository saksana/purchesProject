<?php
$username = "";
$password = "";
if (isset($_GET['usn'])) {
    $username = $_GET['usn'];
}
if (isset($_GET['psw'])) {
    $password = $_GET['psw'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        .button-5 {
            align-items: center;
            background-clip: padding-box;
            background-color: #fa6400;
            border: 1px solid transparent;
            border-radius: .25rem;
            box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 1.25;
            margin: 0;
            min-height: 3rem;
            padding: calc(.875rem - 1px) calc(1.5rem - 1px);
            position: relative;
            text-decoration: none;
            transition: all 250ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            width: auto;
        }

        .button-5:hover,
        .button-5:focus {
            background-color: #fb8332;
            box-shadow: rgba(0, 0, 0, 0.1) 0 5px 12px;

        }

        .button-5:hover {
            transform: translateY(-1px);
        }

        .button-5:active {
            background-color: #c85000;
            box-shadow: rgba(0, 0, 0, .06) 0 2px 4px;
            transform: translateY(0);
        }
    </style>
</head>

<body class="" style="background-color:#d9d9d9">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container" style="background-color:#d9d9d9" ;>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 d-flex flex-column align-items-center justify-content-center text-white py-2" style="background-color:#ff9900">
                                    <img src="img/login4.png" class="" style="width:120px;height:120px">
                                    <h5 class="text-dark mt-2 text-white">ເຂົ້າໃຊ້ງານລະບົບ</h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 bg-white py-4">
                                    <div class="text-end">
                                        <a class="btn btn-sm btn-dark" onclick="history.back()">ກັບຄືນ</a>
                                    </div>

                                    <div class="text-center mt-1">
                                        <h4 class="">ເຂົ້າສູ່ລະບົບ</h4>
                                    </div>
                                    <form name="loginForm" action="checklogin.php" method="POST" onsubmit="return validateForm()">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="typeEmailX-2">ຊື່ຜູ້ໃຊ້</label>
                                            <label id="errusername" class="float-end text-danger"></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-user"></i></i></span>
                                                <input name="username" type="text" id="username" class="form-control " placeholder="" value="<?php echo $username ?>" onclick="clearErr(this.name)" />
                                            </div>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="typePasswordX-2">ລະຫັດຜ່ານ</label>
                                            <label id="errpassword" class="float-end text-danger"></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-lock"></i></span>
                                                <input name="password" type="password" id="password" class="form-control" placeholder="" value="<?php echo $password ?>" onclick="clearErr(this.name)" />
                                            </div>
                                        </div>
                                        <!-- Checkbox -->
                                        <div class="text-center mb-2">
                                            <input class="button-5 py-2 px-4" type="submit" value="ເຂົ້າສູ່ລະບົບ">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            if (username == "" && password == "") {
                document.getElementById("errusername").innerHTML = "*ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້ງານ";
                document.getElementById("errpassword").innerHTML = "*ກະລຸນາປ້ອນລະຫັດຜ່ານ";
                return false;

            } else if (username == "") {
                document.getElementById("errusername").innerHTML = "*ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້ງານ";
                return false;

            } else if (password == "") {
                document.getElementById("errpassword").innerHTML = "*ກະລຸນາປ້ອນລະຫັດຜ່ານ";
                return false;
                document.getElementById("password").focus();

            }
        }

        function clearErr(name) {
            if (name == "username") {
                document.getElementById("errusername").innerHTML = "";
            } else {
                document.getElementById("errpassword").innerHTML = "";
            }
        }
    </script>
</body>

</html>