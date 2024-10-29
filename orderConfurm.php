<?php
use models\BaseModel;
include('lib/DBConnection.php');
include('models/BaseModel.php');
include('helper/help.php');
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
<br>

<div class="container" >
    <div class="row" >
        <div class="col-md-8 col-lg-8 col-sm-12  " >
            <?php
            if(isset($_GET['product_id'])) {
                $product_id = $_GET['product_id'];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST['Name'];
                    $phone = $_POST['Phone'];
                    $city = $_POST['City'];
                    $country = $_POST['Country'];
                    $destic = $_POST['Destic'];
                    $tnana = $_POST['Tnana'];
                    $place = $_POST['Place'];
                    $message = $_POST['message'];

                    $currentDateTime = date("Y-m-d H:i");
                    if (empty($name) || empty($phone) || empty($city) || empty($country) || empty($destic) || empty($tnana) || empty($place)) {
                        echo "<h3>Please Fill All Data </h3>";
                    } else {
                        $model = new BaseModel('orders');
                        $model->readyForInsert([
                            'name' =>$name,
                            'phone' =>$phone,
                            'country' =>$country,
                            'city' =>$city,
                            'distic' =>$destic,
                            'thana' =>$tnana,
                            'place' =>$place,
                            'message' =>$message,
                            'date' =>$currentDateTime,
                            'product_id' =>$product_id,
                        ]);
                        $savequry = $model->save();
                        if ($savequry) {
                            echo "<h3> Order Confrmed </h3>";
                        } else {
                            echo "<h3> Sorry Order Could not Confurm</h3>";
                        }
                    }
                }
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data" >
                <div class="contact-form  mb-3" style="padding: 30px;">
                    <div id="success"></div>
                    <div class="border border-4 border-light p-4 bg-light shadow-lg">
                        <form  name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12" >
                                    <div class="control-group">
                                        <label for="name" class="form-label"  >Name</label>
                                        <input type="text" class="form-control p-2 border border-2 border-primary" id="name" name="Name" placeholder="Your Name" required="required"  />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="control-group col-md-6 col-lg-6 col-sm-12">
                                    <label for="phone" class="form-label" >Phone</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="phone" name="Phone" placeholder="Phone" required="required"  />
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="control-group col-md-6 col-lg-6 col-sm-12 ">
                                    <label for="Country" class="form-label">Country</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="Country" name="Country" placeholder="Country" required="required"  />
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="control-group col-md-6 col-lg-6 col-sm-12">
                                    <label for="City" class="form-label">City</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="City" name="City" placeholder="City" required="required"  />
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="control-group col-md-6 col-lg-6 col-sm-12">
                                    <label for="Destic" class="form-label">Destic</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="Destic" name="Destic" placeholder="Destic" required="required"  />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group col-md-6 col-lg-6 col-sm-12">
                                    <label for="Thana" class="form-label">Thana</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="Thana" name="Tnana" placeholder="Thana" required="required"  />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group ">
                                    <label for="Place" class="form-label">Place</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="Place" name="Place" placeholder="Place" required="required"  />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group ">
                                    <label for="message" class="form-label" >Other Information</label>
                                    <textarea class="form-control border border-2 border-primary" rows="4" id="message" name="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="">
                                    <button class="btn btn-outline-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton">Order</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12">
            <div class="bg-light mb-3 mt-5 shadow-lg border border-4 border-light " style="padding: 30px;">
                <h6 class="font-weight-bold">Get in touch</h6>
                <p>Labore ipsum ipsum rebum erat amet nonumy, nonumy erat justo sit dolor ipsum sed, kasd lorem sit et duo dolore justo lorem stet labore, diam dolor et diam dolor eos magna, at vero lorem elitr</p>
                <div class="d-flex align-items-center mb-3">
                    <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                    <div class="d-flex flex-column">
                        <h6 class="font-weight-bold">Our Office</h6>
                        <p class="m-0">123 Street, New York, USA</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fa fa-2x fa-envelope-open text-primary mr-3"></i>
                    <div class="d-flex flex-column">
                        <h6 class="font-weight-bold">Email Us</h6>
                        <p class="m-0">info@example.com</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-2x fa-phone-alt text-primary mr-3"></i>
                    <div class="d-flex flex-column">
                        <h6 class="font-weight-bold">Call Us</h6>
                        <p class="m-0">+012 345 6789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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