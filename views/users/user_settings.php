<div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:125vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="20"
            >
            </nav>
          

    <div class="section">
      <div class="container">
      <h1 class="heading h1" data-aos="fade-up">Update Profile</h1>
        <div class="row">
        <form action="/user_settings?id=<?php  echo $user['id'] ?>" method="post" enctype="multipart/form-data">
                        <div  data-aos="fade-up" data-aos-delay="20">
                            <div class="d-flex justify-content-start">
                                <div class="image-container mt-0">
                                    <img src="/<?php  echo $user['user_image'] ?>" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary py-1 px-2 mb-4" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none py-1 px-2 mb-4" id="btnDiscard" value="Discard Changes" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab"  role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" role="tab" aria-controls="connectedServices" aria-selected="false">Connected Socials</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="resetPassword-tab" data-toggle="tab" role="tab" aria-controls="resetPassword" aria-selected="false">Reset Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                    <?php  if(!empty($errors_info) ):  ?>
                                        <div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                                            <?php foreach($errors_info as $error) : ?>
                                        <div>
                                            <?php echo $error   ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                                        </div>
                                            <?php endforeach ?>
                                        </div>
                                            <?php endif;?>
                                    <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;" class="form-label">First Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="first_name"
                                                value= "<?php  echo $user['first_name'] ?>"
                                                placeholder="Click here to enter"
                                            />
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;" class="form-label">Last Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="last_name"
                                                placeholder="Click here to enter"
                                                value= "<?php  echo $user['last_name'] ?>"
                                            />
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;" class="form-label">Phone no</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input
                                            type="number"
                                            class="form-control"
                                            name="phone_no"
                                            placeholder="Click here to enter"
                                            value= "<?php  echo $user['phone_no'] ?>"
                                            />
                                            </div>
                                        </div>
                                        <hr />
                                        
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;" class="form-label">Email</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input
                                                type="email"
                                                class="form-control"
                                                name="email"
                                                placeholder="Click here to enter"
                                                value= "<?php  echo $user['email_address'] ?>"
                                            />
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="col-12">
                                        <input
                                            type="submit"
                                            value="Update Profile"
                                            class="btn btn-primary"
                                        />
                                        </div>
                                        </form>
                                    <!--  -->

                                    </div>

                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                        <p class="text-white h6">Connect your Facebook, Instagram,Linkedin, Twitter Account to this account by copying and pasting the Url</p><br>
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
                                        <form action="/user_update_socials?id=<?php  echo $user['id'] ?>" method="post">
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;" class="form-label">Instagram</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                <input
                                                type="url"
                                                class="form-control"
                                                name="instagram"
                                                placeholder="Click here to enter"
                                                value= "<?php  echo $user['instagram'] ?>"
                                                />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;" class="form-label">Twitter</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                <input
                                                type="url"
                                                class="form-control"
                                                name="twitter"
                                                placeholder="Click here to enter"
                                                value= "<?php  echo $user['twitter'] ?>"
                                                />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;" class="form-label">Facebook</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                <input
                                                type="url"
                                                class="form-control"
                                                name="facebook"
                                                placeholder="Click here to enter"
                                                value= "<?php  echo $user['facebook'] ?>"
                                                />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;" class="form-label">Linkedin</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                <input
                                                type="url"
                                                class="form-control"
                                                name="linkedin"
                                                placeholder="Click here to enter"
                                                value= "<?php  echo $user['linkedin'] ?>"
                                                />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="col-12">
                                            <input
                                                type="submit"
                                                value="Update Socials"
                                                class="btn btn-primary"
                                            />
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="resetPassword" role="tabpanel" aria-labelledby="resetPassword-tab">    
                                    <?php  if(!empty($errors_password) ):  ?>
                                        <div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                                            <?php foreach($errors_password as $error) : ?>
                                        <div>
                                            <?php echo $error   ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                                        </div>
                                            <?php endforeach ?>
                                        </div>
                                            <?php endif;?>
                                    <form action="/user_reset_password?id=<?php  echo $user['id'] ?>" method="post">
                                        <div class="row">
                                            <div class="row">
                                            <div class="col-sm-6 col-md-3 col-5">
                                                <label style="font-weight:bold;" class="form-label">New Password</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input
                                                type="password"
                                                name="password"
                                                class="form-control"
                                                value= ""
                                                placeholder="Click here to enter"
                                            />
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-6 col-md-3 col-5">
                                                <label style="font-weight:bold;" class="form-label">Confirm Password</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            <input
                                                type="password"
                                                name="confirm_password"
                                                class="form-control"
                                                value= ""
                                                placeholder="Click here to enter"
                                            />
                                            </div>
                                        </div>
                                        <hr />
                                            <div class="col-12">
                                            <input
                                                type="submit"
                                                value="Reset"
                                                class="btn btn-primary"
                                            />
                                            </div>
                                        </div>
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>

        </div>
      </div>
    </div>
    </div>
        </div>
      </div>
    </div>

 <style>
        .form-label{
            font-size: 16px;
            color: white;
        }
        .form-control{
            height: 38px;
            font-weight: 500;
            background-color: transparent;
            color: white;
            border: 0;
        }
        .form-control:focus, .form-control:active {
            background: transparent;
            color: white;
        }
            img{
                width :150px;
                height :80px;
            }
            hr{
                color: white;
            }
            .image-container {
            position: relative;
            margin-bottom: 30px;
        }
        .nav-link{
            color: white;
            font-weight: 500;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
            
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .image-container:hover .image {
            opacity: 0.3;
        }

        .image-container:hover .middle {
            opacity: 1;
        }
    </style>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $imgSrc = $('#imgProfile').attr('src');
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgProfile').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#btnChangePicture').on('click', function () {
                // document.getElementById('profilePicture').click();
                if (!$('#btnChangePicture').hasClass('changing')) {
                    $('#profilePicture').click();
                }
                else {
                    // change
                }
            });
            $('#profilePicture').on('change', function () {
                readURL(this);
                $('#btnChangePicture').addClass('changing');
                // $('#btnChangePicture').attr('value', 'Confirm');
                $('#btnDiscard').removeClass('d-none');
                // $('#imgProfile').attr('src', '');
            });
            $('#btnDiscard').on('click', function () {
                // if ($('#btnDiscard').hasClass('d-none')) {
                $('#btnChangePicture').removeClass('changing');
                $('#btnChangePicture').attr('value', 'Change');
                $('#btnDiscard').addClass('d-none');
                $('#imgProfile').attr('src', $imgSrc);
                $('#profilePicture').val('');
                $('#btnDiscard').addClass('d-none');
                // }
            });
            $('#connectedServices-tab').on('click', function () {
                $('#connectedServices-tab').addClass('active');
                $('#connectedServices').addClass('show');
                $('#connectedServices').addClass('active');
                $('#basicInfo').removeClass('show');
                $('#basicInfo').removeClass('active');
                $('#basicInfo-tab').removeClass('active');
                $('#resetPassword').removeClass('show');
                $('#resetPassword').removeClass('active');
                $('#resetPassword-tab').removeClass('active');
            });
            $('#basicInfo-tab').on('click', function () {
                $('#basicInfo-tab').addClass('active');
                $('#basicInfo').addClass('show');
                $('#basicInfo').addClass('active');
                $('#connectedServices').removeClass('show');
                $('#connectedServices').removeClass('active');
                $('#connectedServices-tab').removeClass('active');
                $('#resetPassword').removeClass('show');
                $('#resetPassword').removeClass('active');
                $('#resetPassword-tab').removeClass('active');
            });
            $('#resetPassword-tab').on('click', function () {
                $('#resetPassword').addClass('show');
                $('#resetPassword').addClass('active');
                $('#resetPassword-tab').addClass('active');
                $('#basicInfo').removeClass('show');
                $('#basicInfo').removeClass('active');
                $('#basicInfo-tab').removeClass('active');
                $('#connectedServices-tab').removeClass('active');
                $('#connectedServices').removeClass('show');
                $('#connectedServices').removeClass('active');
            });
        });
            <?php if(!empty($errors_password)):?>
                $('#resetPassword').addClass('show');
                $('#resetPassword').addClass('active');
                $('#resetPassword-tab').addClass('active');
                $('#basicInfo').removeClass('show');
                $('#basicInfo').removeClass('active');
                $('#basicInfo-tab').removeClass('active');
                $('#connectedServices-tab').removeClass('active');
                $('#connectedServices').removeClass('show');
                $('#connectedServices').removeClass('active');
                <?php endif; ?>
            <?php if(!empty($errors_info) ):?>
                $('#basicInfo-tab').addClass('active');
                $('#basicInfo').addClass('show');
                $('#basicInfo').addClass('active');
                $('#connectedServices').removeClass('show');
                $('#connectedServices').removeClass('active');
                $('#connectedServices-tab').removeClass('active');
                $('#resetPassword').removeClass('show');
                $('#resetPassword').removeClass('active');
                $('#resetPassword-tab').removeClass('active');
                <?php endif; ?>
    </script>
