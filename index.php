<?php
use models\BaseModel;

include('lib/DBConnection.php');
include('models/BaseModel.php');
include('helper/help.php');
$fm = new format();
?>

<!DOCTYPE html>
<html lang="en">

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

<body style="ba">

  <!-- navbar -->
<?php include('layouts/navbar.php') ?>
<!--   navber end -->
  <br>
  <br>
  <br>


  <header class="container">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="image/carosel-image-no2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="image/carosel-image-1.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
          <img src="image/carosel.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
          <img src="image/carosel-image-no2.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </header>
<!--  carosel end-->

  <br>
  <section class="container bg-light">
    <div class="row">
      <div class="col-md-5 col-sm-12 col-xs-12">
        <img src="image/model1.jpg" class="img-fluid " alt="">
      </div>
      <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="row">
            <?php

//            $updateModel =  new BaseModel( 'images');
//            $upImg = $updateModel->radyForUpdate([
//                'image_name'=> 'hhhh',
//                'type'=> 'jjjj',
//            ]);
//            $uppImg = $upImg->update('id', 8);
////            dd($uppImg);


            $model = new BaseModel('product');
            $postData = $model->select('`id`, `title`, `dicription`, `tags`, `stole_status`, `date`, `price`, `ratting`, `model`')
                ->get();

            if($postData){
            foreach($postData as $kye => $post){?>
            <?php
                $model = new BaseModel('images');
                $image = $model->select('`image_name`')->where('product_id', $post->id)->orderBy('id', 'ASC')->first();
            ?>
          <div class="col-md-4 col-sm-6 col-xs-12">
              <a class="text-decoration-none" href="productdtl.php?openpro=<?php echo $post->id;?> ">
                  <div class="card border-0">
                      <img src="<?php echo $image ? $image->image_name : 'https://www.iaei.org/global_graphics/default-store-350x350.jpg'?>" height="220" width="250" class="card-img-top" alt="...">
                      <div class="card-body">
                          <p class="card-text"><?php echo $post->title;?></p>
                          <p class="card-text"><?php echo $post->model;?></p>
                          <div class="d-flex justify-content-between">
                              <span class="text-primary"><?php echo $post->price;?></span>
                              <span class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                              </span>
                          </div>
                      </div>
                  </div>
              </a>

          </div>
            <?php }}?>
        </div>
      </div>
    </div>
  </section>
  <br>


  <section class="container bg-white">
    <div class="text-center my-5">
      <p class="h4"> Tranding product</p>
    </div>
    <div class="row">

        <?php
        $model2 = new BaseModel('product');
        $data = $model2->select('`id`, `title`, `dicription`, `tags`, `stole_status`, `date`, `price`, `ratting`, `model`')
        ->get();
        if($data){
            foreach($data as $kye => $post){

                $model3 = new BaseModel('images');
                $image = $model3->select('image_name')->where('product_id',$post->id)->orderBy('id','ASC')
                    ->first();
            ?>

          <div class="col-md-3 col-sm-12 col-xs-12  py-2 shadow">
              <a class="text-decoration-none" href="productdtl.php?openpro=<?php echo $post->id ;?>" >
                <div class="d-flex justify-content-between">
                  <span class="bg-primary px-3 rounded text-white">sale</span>
                  <span class="text-primary"><i class="bi bi-code"></i> compare</span>
                </div>
              <img class="image-fluid" src="<?php echo $image ? $image->image_name : ""  ;?>" height="220" width="300" alt="">
                <span class="text-secondary"><?php echo $post->title ;?></span>
                <p class="h6"><?php echo $fm->textshort($post->dicription ,100) ; ?></p>
                <div class="d-flex justify-content-between">
                  <span class="text-primary"><?php echo $post->price;?></span>
                  <span class="text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <i class="bi bi-star"></i>
                  </span>
                </div>
                <button class="btn btn-primary w-100 my-3"><i class="bi bi-cart-dash"></i> Add to Card</button>
                <a class="btn btn-outline-primary w-100">Quick View</a>
          </div>
        </a>
        <?php }}?>
    </div>
  </section>

  <section class="container my-5 ">
    <p class="h4 text-center"> Know Me More</p>
    <div class="row">


      <div class=" col-md-7 col-sm-12 col-xs-12  ">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                Our Service
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                  <?php
                  $model = new BaseModel('our_rulse') ;
                  $postdata = $model->select('id, service, rulse, history, details')
                      ->get() ;
                  if($postdata){
                      foreach ($postdata as $post){?>
                          <div class="accordion-body">
                              <?php echo $post->service ;?>
                          </div>
                      <?php }} ?>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Our Rules
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                  <?php
                  $model = new BaseModel('our_rulse') ;
                  $postdata = $model->select('id, service, rulse, history, details')
                      ->get() ;
                  if($postdata){
                      foreach ($postdata as $post){?>
                          <div class="accordion-body">
                              <?php echo $post->rulse ;?>
                          </div>
                      <?php }} ?>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Our History
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                  <?php
                  $model = new BaseModel('our_rulse') ;
                  $postdata = $model->select('id, service, rulse, history, details')
                      ->get() ;
                  if($postdata){
                      foreach ($postdata as $post){?>
                          <div class="accordion-body">
                              <?php echo $post->history ;?>
                          </div>
                      <?php }} ?>
              </div>
            </div>
          </div>
        </div>


        <button class="btn btn-outline-primary mt-3" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          Click for More Details
        </button>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
          aria-labelledby="offcanvasExampleLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">More Manu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">


              <?php
              $model = new BaseModel('our_rulse') ;
              $postdata = $model->select('id, service, rulse, history, details')
                  ->get() ;
              if($postdata){
                  foreach ($postdata as $post){?>
                      <div class="accordion-body">
                          <?php echo $post->history ;?>
                      </div>
                  <?php }} ?>
            <div class="dropdown mt-3">
              <button class="btn btn-primary w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Open Manu
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.html">Home</a></li>
                <li><a class="dropdown-item" href="toop.php">Product</a></li>
                <li><a class="dropdown-item" href="#">Shop</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-4 col-xs-12 col-sm-12">
        <img class="image-fluid ms-4  " src="image/lady1.jpg" alt="">
      </div>
    </div>
  </section>

  <section class="container">
    <p class="h3 mb-5"> Shop By Brand</p>
    <div class="row bg-white">
        <?php
        $model = new BaseModel('brand') ;
        $postdata = $model->select('`id`, `name`, `image`, `url`')
            ->get();
        if($postdata){
            foreach ($postdata as $key=>$post){?>

      <div style="height:100px; width: 200px;" class="col-md-2 col-sm-4 col-xs-6 ms-3 shadow-lg p-auto border border-1 text-center">
        <a target="_blank" href="<?php echo $post->url ;?>"> <img src="<?php echo $post->image ;?>" class="img-fluid" alt="Image Not Found" style="  height:100px; width: 200px;" ></a>
      </div>
        <?php }} ?>
    </div>
  </section>
  <section class="container">
    <p class="h4  mb-2 mt-5"> Top Selling Products</p>
    <div class="row justify-content-between">

      <div
        class="col-md-5 col-sm-12 col-xs-12 shadow align-item-center d-flex justify-content-around bg-white py-5 px-5">
        <div class="col-5 ">
          <img class="img-fluid" src="image/mobail2.jpg" alt="">
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12 ">
          <p class="text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </p>
          <p>
            This is a vivo phone Which is top selling phone
          </p>
          <p>
            <span class="fw-bold me-3"> <s>$300.50</s></span>
            <span class="text-primary fw-bold">$280.12</span>
          </p>
          <button class="btn btn-primary"> Add To card</button>
        </div>
      </div>

      <div
        class="col-md-5 col-sm-12 col-xs-12 shadow align-item-center d-flex justify-content-around bg-white py-5 px-5">
        <div class="col-5">
          <img class="img-fluid" src="image/laptop1.jpg" alt="">
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p class="text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </p>
          <p>
            This is a Hp laptop Which is top selling Laptop
          </p>
          <p>
            <span class="fw-bold me-3"> <s>$1120.00</s></span>
            <span class="text-primary fw-bold">$1100.12</span>
          </p>
          <button class="btn btn-primary"> Add To card</button>
        </div>
      </div>

      <div
        class="col-md-5 col-sm-12 col-xs-12 shadow align-item-center mt-5 d-flex justify-content-around bg-white py-5 px-5">
        <div class="col-md-5 col-sm-12 col-xs-12">
          <img class="img-fluid" src="image/speaker2.jpg" alt="">
        </div>
        <div class="col-5">
          <p class="text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </p>
          <p>
            This is a Saumi Speaker Which is top selling Speaker
          </p>
          <p>
            <span class="fw-bold me-3"> <s>$11.00</s></span>
            <span class="text-primary fw-bold">$10.12</span>
          </p>
          <button class="btn btn-primary"> Add To card</button>
        </div>
      </div>


      <div
        class="col-md-5 col-sm-12 col-xs-12 shadow align-item-center mt-5 d-flex justify-content-around bg-white py-5 px-5">
        <div class="col-md-5 col-sm-12 col-xs-12">
          <img class="img-fluid" src="image/fan1.jpg" alt="">
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p class="text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </p>
          <p>
            This is a Fan Which is top selling Fan
          </p>
          <p>
            <span class="fw-bold me-3"> <s>$38.00</s></span>
            <span class="text-primary fw-bold">$36.20</span>
          </p>
          <button class="btn btn-primary"> Add To card</button>
        </div>
      </div>
    </div>
  </section>

  <?php include('ad.php') ; ?>

<!--  <section class="container">-->
<!--    <p class="h4 text-center mb-4"> Order Our Product</p>-->
<!--    <div class="row ">-->
<!--      <div class="col-md-6 bg-light">-->
<!--        <div class="d-flex justify-content-between">-->
<!--          <div class="col-5">-->
<!--            <label for="formname" class="form-label"> Name</label>-->
<!--            <input id="formname" class="form-control" type="text" placeholder="Your name">-->
<!--          </div>-->
<!--          <div class="col-5">-->
<!--            <label for="formemil" class="form-label"> Email Address</label>-->
<!--            <input id="formemil" class="form-control" type="text" placeholder="Email Address">-->
<!--          </div>-->
<!--        </div>-->
<!--        <div>-->
<!--          <div class="mt-3">-->
<!--            <label for="forAddress" class="form-label"> Shipping Address</label>-->
<!--            <input id="forAddress" class="form-control" type="text" placeholder="Street Address">-->
<!--            <input id="forAddress" class="form-control mt-3" type="text" placeholder="Street Address">-->
<!--          </div>-->
<!--        </div>-->
<!---->
<!--        <div class="d-flex justify-content-between">-->
<!--          <input class="form-control mt-3 me-5 " type="text" placeholder=" City">-->
<!---->
<!--          <input class="form-control mt-3 " type="text" placeholder="Region">-->
<!---->
<!--        </div>-->
<!--        <div class="d-flex justify-content-between">-->
<!--          <div class="col-5 me-5">-->
<!--            <input class="form-control mt-3" type="number" placeholder="Zip Code">-->
<!--          </div>-->
<!---->
<!--          <div class="col-5">-->
<!--            <select class="form-select mt-3 ">-->
<!--              <option selected> Your Country</option>-->
<!--              <option value="1"> Bangladesh</option>-->
<!--              <option value="2"> India</option>-->
<!--              <option value="3">pakisthan</option>-->
<!--              <option value="4"> Japan</option>-->
<!--              <option value="5"> chin </option>-->
<!--              <option value="6"> Rasia</option>-->
<!--              <option value="7">Napal </option>-->
<!--            </select>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="mt-3">-->
<!--          <label class="form-label" for="Massage"> Write Any Message</label>-->
<!--          <textarea class="form-control" id="Massage" cols="5" rows="5"></textarea>-->
<!--        </div>-->
<!--        <button class="btn btn-primary w-100 mt-3"> Order Confarm-->
<!--        </button>-->
<!--      </div>-->
<!---->
<!--      <div class="col-md-6 border-3 bg-light ">-->
<!--        <img class="text-center" width="600" height="600" src="image/contact1.jpg" alt="">-->
<!--      </div>-->
<!--    </div>-->
<!--  </section>-->

  <?php include('layouts/footer.php') ?>
  <br>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>