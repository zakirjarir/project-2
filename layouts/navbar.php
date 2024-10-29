<nav class="navbar navbar-expand-md bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-white fs-4" href="index.php">ZH Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="login.php" class="btn btn-outline-info"> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="toop.php"> Top Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item dropdown text-white">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Catagory
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" target="blank" href="">Electric Product</a></li>
                        <?php
                        $model = new \models\BaseModel('catagory');

                        $postdata = $model->select('id,name')
                            ->get();
                        if($postdata){
                            foreach($postdata as $kye =>$value){
                        ?>

                        <li><a class="dropdown-item" target="blank" href=""><?php echo $value->name ; ?></a>
                       <?php }}?>
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <a href="" class="btn btn-outline-info text-white" type="submit">Search </a>
            </form>
        </div>
    </div>
</nav>