
    <div
      class="hero page-inner overlay"
      style="background-image: url('/<?php echo $property['imagePath']?>')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">
            <?php echo $property['property_address']?>
            </h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item">
                  <a href="/properties">Properties</a>
                </li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                <?php echo $property['property_type']?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-7">
            <div class="img-property-slide-wrap">
              <div class="img-property-slide">
                <?php foreach($images as $i => $image):?>
                
                <img src="/<?php echo $image['imagePath']?>" alt="Image" class="img-fluid" style=" height:100vh;"/>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <p class="text-black-50">
                <p class="meta"><u>Description</u></p>
                <p class="text-black-50"> This property is located at <strong class="text-primary"><?php echo $property['property_address']?>.</strong>
                  It is a/an <strong class="text-primary"><?php echo $property['property_type']?></strong> 
                  with <?php echo $property['bed']?> bedroom(s), <?php echo $property['bath']?> bathroom(s) and <?php echo $property['kitchen']?>
                  kitchen(s).</p>
                <p class="meta"><em>Agent's comment: <?php echo $property['description']?>.</em></p>
                <p>This property is currently <strong class="text-primary"><?php echo $property['property_status']?></strong></p>
                <?php if (!($property['property_status'] == 'Sold')): ?>
                  <?php $id = $_GET['id']; ?>
                  <h6>Are you interested in this property? If yes, Click 
                  <form method="post" action="/property/request" style="display: inline-block;">
                      <input type="hidden" name = "request_id" value="<?php echo $property['property_id'] ?>">
                      <button type="submit"  class="text-warning btn btn-link py-1 px-1">Here</button>
                      </form>
                    </h6>
                <?php endif ?>
             </p>
          <?php if($property['role_id'] == 3):?>
            <div class="d-block agent-box p-5">
              <div class="img mb-4">
                <img
                  src="/<?php echo $property['user_image']?>"
                  alt="Image"
                  class="img-fluid"
                />
              </div>
              <div class="text">
                <h3 class="mb-0"><?php echo $property['first_name']." ".$property['last_name']?></h3>
                <div class="meta mb-3">Agent In Charge of this Property</div>
                <ul class="list-unstyled social dark-hover d-flex">
                  <li class="me-1">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                </ul>
              </div>
            </div>
            <?php endif ?>
          </div>
        </div>
        <a href="/properties" class="btn  btn-warning">Go back</a>
      </div>
    </div>

 