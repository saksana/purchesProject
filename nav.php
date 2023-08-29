<nav class="navbar navbar-dark fixed-top" style="background-color:	#f98006">
    <div class="container-fluid px-4">
        <div class="me-auto">
            <a class="navbar-brand" href="#" style="font-family: 'Trebuchet MS'">File Management</a>
        </div>
        <div class="dropdown me-3">
            <a class="" href="" data-bs-toggle="dropdown" style="color:white;text-decoration:none"><i class="fa-regular fa-circle-user fs-4"></i> <?php echo $_SESSION['file_fullname'] ?></a>
            <ul class="dropdown-menu">
                <li class="text-danger"><a class="dropdown-item text-danger" href="logout.php">ອອກຈາກລະບົບ</a></li>
            </ul>
        </div>
    </div>
</nav>