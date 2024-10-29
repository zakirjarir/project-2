<?php
use models\BaseModel;

include('lib/DBConnection.php');
include('models/BaseModel.php');
include('helper/help.php');

$db = new DBConection();
$condb = $db->conaction();
$fm = new format();
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZH Shop</title>
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include('layouts/navbar.php')  ?>
<br>
<br>
<br>
<br>
<section class="container bg-light">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12" id="image_slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <?php
                    if (isset($_GET['openpro'])) {
                        $openid = $_GET['openpro'];

                        $images = [];
                        $model = new BaseModel('product');
                        $postData = $model->select()->where('id', $openid)->first();

                        if ($postData) {
                            $model = new BaseModel('images');
                            $images = $model->select('`image_name`')->where('product_id', $openid)->orderBy('id', 'DESC')->get();
                        }
                    }
                    ?>

                    <div class="carousel-inner">
                    <?php
                    foreach ($images as $key => $image) {
                        ?>

                            <div class="carousel-item <?php echo $key == 0 ? 'active' : '' ?>">
                                <img src="<?php echo $image->image_name   ?>" class="d-block w-100" alt="...">
                            </div>
                    <?php }?>
                        </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="text-dark">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="text-dark">Next</span>
                </button>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <br>
                    <?php
                    if (isset($_GET['openpro'])) {
                        $openid = $_GET['openpro'];
                        $model = new BaseModel('product');
                        $postData = $model->select()->where('id', $openid)->first();

                        if ($postData) {
                            ?>

                            <span class=" fs-5 ms-3"> <?php echo $postData->title ; ?>   </span>
                            <div class=" ms-3" >
                                <span class="fs-3" ><?php echo $postData->model ; ?></span> <br>
                                <span class="fs-5" ><?php echo $fm->textshort($postData->dicription ,250) ; ?></span>
                            </div>

                            <div class=" mt-4 ms-3" >
                                <span class="text-primary h4 me-4 "><?php echo $postData->price;?></span>
                                <span class="text-warning h5 ms-4 ">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                                </span>
                                <br>
                                <br>
                                <p> <?php echo $postData->date ; ?>  </p>
                            </div>
                            <div class="">
                                <a class="btn btn-outline-primary ms-3" href="orderConfurm.php?product_id=<?php echo $postData->id; ?>">Order Now</a>
                                <a class="btn btn-outline-primary ms-2" href="favorite.php?id=<?php echo $postData->id; ?>">Add to Favorite</a>
                            </div>
                            <?php
                        } else {
                            echo "<h5>Product not found.</h5>";
                        }
                    } else {
                        echo "<h5>No product specified.</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div>
        <br>
        <br>
        <br>
        <h5>Product Information</h5>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati temporibus quasi laborum corrupti fugit beatae ut ipsum deserunt reprehenderit, natus expedita autem esse aperiam doloremque optio hic sequi excepturi iusto officiis velit qui voluptate? Assumenda eius, incidunt voluptatibus blanditiis voluptate id repellat amet minima sit temporibus enim provident fugiat corrupti, quos debitis consequuntur nihil dicta eligendi aperiam optio illo, voluptatum expedita dolorum dolores. Omnis aut vitae sint eveniet cum exercitationem voluptas magni nisi ad repudiandae? Aut reiciendis ullam vitae voluptates earum, vero dolore rerum incidunt quibusdam perferendis obcaecati praesentium maxime dolores fuga consectetur pariatur corrupti dicta dolorem saepe. Beatae, accusamus necessitatibus? Voluptatem fugit ullam, inventore dolores nihil, dolore sed tempora ratione excepturi vitae temporibus officia optio vel, deserunt repellendus architecto deleniti ipsam nesciunt unde dolorum quasi facere. Ex accusantium corporis soluta fuga quasi eaque, tempore totam eveniet incidunt voluptas aliquam iusto laborum praesentium consectetur excepturi rerum! Error cum dolorum omnis reprehenderit eos totam, iusto id nesciunt corporis, facilis obcaecati amet blanditiis saepe assumenda nobis, doloremque reiciendis rem itaque dolor consequatur! Hic mollitia, assumenda dolor ipsum, eaque aut tenetur officiis illo, molestiae ratione porro nemo earum. Veritatis veniam beatae neque? Illum laborum fuga, nemo ullam quod esse. Praesentium minus blanditiis quis illum itaque vel, dolore aspernatur accusantium? A quidem ut eius, recusandae repudiandae aut facere optio reiciendis doloribus voluptate explicabo aperiam. Maiores necessitatibus iure alias numquam impedit dolorum id placeat. Quidem pariatur ipsa omnis! Doloremque consequuntur similique sunt facilis error dicta nemo ullam vero ducimus ut, natus laudantium aperiam quo corrupti quam suscipit eaque assumenda obcaecati? Delectus modi quod rerum omnis magni esse cumque, porro commodi voluptates mollitia, at totam iste doloribus vero amet explicabo ab nulla praesentium facilis. Cumque sint necessitatibus eaque nostrum quam! Dolorem doloremque, rerum expedita sed repellat sequi eius deserunt temporibus impedit laudantium ratione eligendi. Blanditiis animi rerum, ea minus eius nisi dolorem, reiciendis corporis inventore non ad ratione. Impedit minima repellat laboriosam est reiciendis quibusdam. Soluta reiciendis iusto vel illo rerum quasi! Vero, eos quia. Dicta non nesciunt quo sapiente doloremque, esse et harum atque ducimus perspiciatis nulla numquam voluptatum repudiandae sint quasi quibusdam laudantium qui. Quibusdam nihil voluptates maiores repellat iusto aut ab molestiae, maxime nostrum molestias labore quod dolore cupiditate laborum doloremque voluptate odio dignissimos! Assumenda, placeat? Rem quos sint explicabo molestias adipisci totam perspiciatis aspernatur, deleniti atque, perferendis, minus harum placeat laudantium molestiae laborum illo hic? Pariatur voluptatem aperiam dolores vitae ut nostrum!
        </p>
    </div>



<?php include('ad.php') ; ?>

<?php include('layouts/footer.php')  ?>
<script src="slaider.js" ></script>
<!--js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>