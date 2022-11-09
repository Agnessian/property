
    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height: 80vh;">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
          <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="20"
            ></nav>
            <div class="section">
            <div class="container">
                <div class="row">
                <div class="container mt-4">
                <h1 class="heading" data-aos="fade-up">Login</h1>
                <div class=" " style="margin: 0 auto;" data-aos="fade-up" data-aos-delay="20">
                <?php  if(!empty($errors) ):  ?>
                <div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                    <?php foreach($errors as $error) : ?>
                <div>
                    <?php echo $error   ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
                    <?php endforeach ?>
                </div>
                    <?php endif;?>
                    <form action="/login" method="post">
                    <div class="row" style="opacity: 0.6 !important;">
                        <div class="col-8 mb-3 "  style="margin-left: 16%;">
                        <input
                            type="text"
                            name="email"
                            class="form-control"
                            placeholder="Email"
                            value= "<?php  echo $user['email'] ?>"
                        />
                        </div>
                        <div class="col-8 mb-3" style="margin-left: 16%;">
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                            value= "<?php  echo $user['password'] ?>"
                        />
                        </div>

                        <div class="col-12">
                        <input
                            type="submit"
                            value="Login"
                            class="btn btn-primary"
                        />
                        </div>
                    </div>
                    </form>
                    <?php if (!isset($_SESSION['roleId'])):?>
                            <h6 class="h6 text-white mt-3" data-aos="fade-up"><em>
                               Have no Account, click <a href="/sign_up" class="text-warning">here</a> to sign up 
                                </em>
                            </h6>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['roleId'])):?>
                            <h6 class="h6 text-warning mt-3" data-aos="fade-up"><em>
                                You are logged in already
                                </em>
                            </h6>
                    <?php endif; ?>
                   <h6 class="h6 text-white mt-3" data-aos="fade-up"><em>
                              <a href="/forgot_password" class="text-warning">Forget Password?</a>
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
    </div>

   