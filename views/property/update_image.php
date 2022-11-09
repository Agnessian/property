<div class="hero page-inner overlay"
      style="background-image: url('/images/hero_bg_1.jpg'); height:50vh;">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Update Images</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-properties">
      <div class="container">
        <div class="row">
        <?php  foreach ($images as $i => $item): ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-3">
             <div class="property-item">
              <div class="box">
                    <img src="/<?php  echo $item['imagePath'];  ?>" alt="...Property image" class="img-fluid" style="width: 360px; height:350px;" />
              </div>
              <div class="property-content">
                
                      <form method="post" action="/property/delete_image" style="display: inline-block;">
                      <input type="hidden" name = "image_id" value="<?php echo $item['id']; ?>">
                      <input type="hidden" name = "imagePath" value="<?php echo $item['imagePath']; ?>">
                      <input type="hidden" name = "unique_code" value="<?php echo $item['unique_code']; ?>">
                      <button type="submit"  class="btn btn-primary mb-1 py-2 px-3">delete</button>
                      </form>
                    </div>
                  </div>
            </div>
            <?php  endforeach; ?>
        <?php if(empty($images)): ?>
                <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                <center><strong>No images</strong></center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
                <?php endif; ?>

<form method="post" action="/property/update_image?id=<?php echo $item['unique_code'] ?>" enctype="multipart/form-data" style="display: inline-block;">
        <div class="col-md-12 mb-1">
        <?php if (!(isset($i))): ?>
                <?php $i = -1 ?>
            <?php endif; ?>
            <?php if (isset($i)): ?>
                <?php if ($i < 4): ?>
                    <div class="form-group fieldGroup">
                        <label class="form-label">Property images</label>
                        <div class="input-group">
                            <input type="file" name="property_image[]" accept="image/x-png, image/gif, image/jpeg" class="form-control" />
                            <input type="hidden" name = "imagePath" value="<?php echo $item['imagePath']; ?>">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success addMore py-2 px-2 ml-5"><span
                                        class="fldemo glyphicon glyphicon glyphicon-plus"
                                        aria-hidden="true"></span>
                                    Add</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif;?>
        </div>
        <div class="position-relative">
            <?php if (isset($i)): ?>
                <?php if ($i < 4): ?>
                <button type="submit" class="btn px-3 py-3 btn-warning position-absolute bottom-1 end-0 mt-2 mb-2">save new image(s)</button>  
                <?php endif;?>
            <?php endif;?>
                <a href="/agent_actions" class="btn btn-primary mb-2 mt-2">Done</a>
        </div>
</form>
        <div class="form-group fieldGroupCopy " style="display: none;">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="file" name="property_image[]" class="form-control" />
                    <div class="input-group-btn">
                        <button class="btn btn-danger remove py-2 px-2"><span
                            class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>Remove</button>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
                            $(document).ready(function() {

                                //new input fields group add limit. $i starts from 0 becaause of the loop and the maximum is 5
                                var images = <?php echo $i; ?>;
                                console.log(images);
                                var maxGroup = 4 - images;

                                //add more fields group
                                $(".addMore").click(function() {
                                    if ($('body').find('.fieldGroup').length < maxGroup) {
                                        var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                                            '</div>';
                                        $('body').find('.fieldGroup:last').after(fieldHTML);
                                    } else {
                                        // alert('Maximum '  ' groups are allowed.');
                                        swal("Maximum of 5 images are allowed.", " ",  "info");
                                    }
                                });

                                //remove fields group
                                $("body").on("click", ".remove", function() {
                                    $(this).parents(".fieldGroup").remove();
                                });



                                //datepickr JS
                                $("#date").flatpickr({
                                    dateFormat: "d-m-Y",
                                });

                            });
    </script>
    <style>
        .form-label{
            font-size: 16px;
            color: white;
        }
        .form-control{
            height: 38px;
            opacity: 0.6 !important;
            font-weight: 500;
        }
            img{
                width :150px;
                height :80px;
            }
        
    </style>
                
      </div>
      </div>
  
