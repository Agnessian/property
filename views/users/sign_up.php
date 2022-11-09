<div
      class="hero page-inner overlay" 
      style="background-image: url('images/hero_bg_1.jpg'); height: 100vh;"
     >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5 " >
          <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            ></nav>
            <div class="section">
            <div class="container">
                <div class="row">
                <h1 class="heading" data-aos="fade-up">Sign Up</h1>
                <div  data-aos="fade-up" data-aos-delay="200">
                  <!-- this will display any possible error -->
                <?php  if(!empty($errors)):  ?>
            <div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
        <?php foreach($errors as $error) : ?>
            <div>
                <?php echo $error   ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
            </div>
                <?php endforeach ?>
            </div>
            <?php endif;?>
            <form action="/sign_up" method="post"  style="opacity: 0.6 !important;" enctype="multipart/form-data">
              <div class="row">
                <div class=" col-12 mb-3">
                    <input type="file" 
                    name="user_image"
                    class="form-control">
                </div>
                <div class="col-6 mb-3">
                  <input
                    type="text"
                    class="form-control"
                    name="first_name"
                    value= "<?php  echo $user['first_name'] ?>"
                    placeholder="Your firstname"
                  />
                </div>
                <div class="col-6 mb-3">
                  <input
                    type="text"
                    class="form-control"
                    name="last_name"
                    placeholder="Your lastname"
                    value= "<?php  echo $user['last_name'] ?>"
                  />
                </div>
                <div class="col-6 mb-3">
                  <input
                  type="text" pattern="[0-9]*"
                    class="form-control"
                    name="phone_no"
                    placeholder="Your Phone Number"
                    
                    value= "<?php  echo $user['phone_no'] ?>"
                  />
                </div>
                <div class="col-6 mb-3">
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="Your Email"
                    value= "<?php  echo $user['email'] ?>"
                  />
                </div>
                <div class="col-12 mb-3">
                  <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="password"
                    value= "<?php  echo $user['password'] ?>"
                  />
                </div>
                <div class="col-12 mb-3">
                  <input
                    type="password"
                    class="form-control"
                    name="confirm_password"
                    placeholder="confirm password"
                    value= "<?php  echo $user['confirm_password'] ?>"
                  />
                </div>
                <div class="col-12" style="opacity: 0.9 !important;">
                  <input
                    type="submit"
                    value="Sign Up"
                    class="btn btn-primary"
                  />
                </div>
              </div>
            </form>
              <h6 class="h6 text-white mt-3" data-aos="fade-up"><em>
                  Have Account, click <a href="/login" class="text-warning">here</a> to login 
                  </em>
              </h6>
          </div>
                </div>
            </div>
            </div>
         </div>
        </div>
      </div>
    </div>