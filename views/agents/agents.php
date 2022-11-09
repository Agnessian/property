    <div
      class="hero page-inner overlay"
      style="background-image: url('/images/hero_bg_1.jpg'); height:55vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">All <?php if($_SERVER['REQUEST_URI'] !== '/agents'){
              echo 'Users';
            } else{
              echo 'Agents';}?>
              </h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li
                  class="breadcrumb-item h6 text-white"
                  aria-current="page"
                > <?php if(($_SERVER['REQUEST_URI'] == '/users') && ($_SESSION['roleId'] == 2)):?>
                Click <a href="/agents" class="text-warning">here</a> to view all Agents
                <?php endif; ?>
                </li>
              </ol>
              <form
              action="" method="get"
              class="narrow-w form-search d-flex align-items-stretch mb-3 py-4 px-4"
              data-aos="fade-up"
              data-aos-delay="20"
            >
              <input
                type="text"
                name = "search"
                class="form-control px-4 py-4"
                value="<?php echo $search ?>"
                placeholder="Search by email e.g. joe@gmail.com"
              />
              <button type="submit" class="btn btn-primary py-2 px-2">Search</button>
            </form>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          
        </div>
      </div>
    </div> -->
    <div class="section section-properties">
      <div class="container">
        <div class="row">
          <?php  foreach ($agents as $i => $item): ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-3">
             <div class="property-item">
              <div class="box">
                    <img src="/<?php  echo $item['user_image'];  ?>" alt="...Property image" class="img-fluid" style="width: 360px; height:350px;" />
              </div>
              <div class="property-content">
                      <span class="city d-block mb-3">
                        <?php if($item['role_id'] == 3){echo 'Agent';} elseif($item['role_id'] == 1){echo 'User';}elseif(($item['role_id'] == 2)){echo 'Admin';}else{echo '';}?> 
                         <?php  echo $item['first_name']." ".$item['last_name']; ?>
                      </span>
                      <span class="d-block mb-3"><?php  echo $item['email_address']; ?></span>
                      <?php if(isset($agents)) :?>
                        <?php if($item['role_id'] == 3) :?>
                      <a
                        href="/agent_property?agent=<?php echo $item['id'] ?>"
                        class="btn btn-primary py-2 px-3 mt-2"
                        >View properties</a
                      >
                      <?php  endif; ?>
                      <?php  endif; ?>
                      <a
                        href="/user_settings?id=<?php echo $item['id'] ?>"
                        class="btn btn-primary py-2 px-3 mt-2"
                        >View profile</a
                      >
                    </div>
                  </div>
            </div>
            
            <!-- .item -->
          
          <?php  endforeach; ?>
        </div>
        <?php if(empty($agents)): ?>
                <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                <center><strong>There is no agent's email related to the searched keyword. kindly Search for Something else</strong></center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 3): ?>
                            <a href="/agent_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 2): ?>
                            <a href="/admin_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
        </div>  
      </div>
  
