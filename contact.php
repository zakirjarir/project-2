<?php ?>
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

    <div class="container" >
        <div class="row" >
            <div class="col-md-8 col-lg-8 col-sm-12  " >
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $name    = $_POST['name'];
                    $email   = $_POST['email'];
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];

                    $currentDateTime = date("Y-m-d H:i");

                    if(empty($name) || empty($email) || empty($subject) || empty($message)){
                        echo "<h3>Please Fill All Data </h3>";
                    }else{
                        $model = new BaseModel( 'contact');
                        $model->readyForInsert([
                            'name' => $name,
                            'email' => $email,
                            'subject' => $subject,
                            'message' => $message,
                            'date' => $currentDateTime
                        ]);
                        $savequry = $model->save();
                        if($savequry){
                            echo "<h3> Message Sent Successful </h3>";
                        }else{
                            echo "<h3> Message Sent Unsuccessful </h3>";
                        }
                    }
                }
                ?>
            <form action="" method="post" enctype="multipart/form-data" >
                <div class="contact-form  mb-3" style="padding: 30px;">
                    <div id="success"></div>
                    <div class="border border-4 border-light p-4 bg-light shadow-lg">
                        <form  name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <label  for="name" class="form-label" >Name</label>
                                        <input type="text" class="form-control p-2 border border-2 border-primary" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <label  for="email" class="form-label" >Email </label>
                                        <input type="email" class="form-control p-2 border border-2 border-primary" id="email" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                                <div class="control-group">
                                    <label for="subject" class="form-label"  >Subject</label>
                                    <input type="text" class="form-control p-2 border border-2 border-primary" id="subject" name="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label for="message" class="form-label" >Message</label>
                                    <textarea class="form-control border border-2 border-primary" rows="4" id="message" name="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="">
                                    <button class="btn btn-outline-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4 col-lg-4 col-sm-12">
                <!--                    data select from officeaddress table-->
                <?php
                $modelofficeaddress = new BaseModel( 'officeaddress');
                $dataofficeaddress = $modelofficeaddress->select(' id, address, phone, email, other ')->get();
                if($dataofficeaddress){
                    foreach($dataofficeaddress as $key => $value){?>

                        <div class="bg-light mb-3 mt-5 shadow-lg border border-4 border-light p-5 " >
                            <h6 class="font-weight-bold">Get in touch</h6>
                            <p><?php echo $value->other;?></p>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                                <div class="d-flex flex-column">
                                    <h6 class="font-weight-bold">Our Office</h6>
                                    <p class="m-0"><?php echo $value->address;?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-2x fa-envelope-open text-primary mr-3"></i>
                                <div class="d-flex flex-column">
                                    <h6 class="font-weight-bold">Email Us</h6>
                                    <p class="m-0"><?php echo $value->email;?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-2x fa-phone-alt text-primary mr-3"></i>
                                <div class="d-flex flex-column">
                                    <h6 class="font-weight-bold">Call Us</h6>
                                    <p class="m-0"><?php echo $value->phone;?></p>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
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
