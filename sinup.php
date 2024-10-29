<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZH Shop Sinup</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include('layouts/navbar.php') ?>


 <br>
 <br>
 <br>
 <br>


 <section class="container " >

 <br>
 <br>
 <br>
 <br>
      <div class="row bg-light">
        <div class="col-md-2 col-sm-2 ">

        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
          <div class="d-flex justify-content-between">
            <div class="col-5">
              <label for="formname" class="form-label"> Name</label>
              <input id="formname" class="form-control" type="text" placeholder="Your Name">
            </div>

          
              <div class="col-5 ms-0">
                <label for="formemil" class="form-label"> Email or Phone</label>
                <input id="formemil" class="form-control" type="text" placeholder="Email or Phone">
              </div>
            
         
          </div>
         <a class="btn btn-primary btn-primary mt-3 w-100">Get OTP Code</a>

  
          <div class="d-flex justify-content-between">
            <input class="form-control mt-3 me-5 " type="number" placeholder="OTP Fill">
  
            <input class="form-control mt-3 " type="text" placeholder="Region">
  
          </div>
          <div class="d-flex justify-content-between">
            <div class="col-5 me-5">
              <input class="form-control mt-3" type="text" placeholder=" City">
            </div>
  
            <div class="col-5">
              <select class="form-select mt-3 ">
                <option selected> Your Country</option>
                <option value="1"> Bangladesh</option>
                <option value="2"> India</option>
                <option value="3">pakisthan</option>
                <option value="4"> Japan</option>
                <option value="5"> chin </option>
                <option value="6"> Rasia</option>
                <option value="7">Napal </option>
              </select>
            </div>
          </div>
         
          <button class="btn btn-outline-primary w-100 mt-3 "> Sinup
          </button>
          <br>
          <br>
        </div>
        <div class="col-md-2 col-sm-2">

        </div>
      </div>
      <br>
      <br>
      <br>
  
  </section>
 

<br>
<br>
<br>
<br>
<br>
<?php include('layouts/footer.php') ?>

</body>
    <!-- Js linl -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
</body>
</html>