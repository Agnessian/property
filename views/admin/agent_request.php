<div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:40vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mb-5">
            <h1 class="heading" data-aos="fade-up">All Agents Request</h1>
            <ol class="breadcrumb text-center justify-content-center">
              <li class="breadcrumb-item h6 text-white"><em>Click <a href="/request_list" class="text-warning">Here </a>to view Request List </em></li>
            </ol>
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
      <div class="container" >
      <div class="table-responsive">
        <table class="table caption-top table-sm table-striped">
            <caption class="h3 mb-4">List of Agents Requests</caption>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Full name</th>
                <th scope="col">Reason for Applying</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($allAgentRequest as $i => $item):  ?>
                <tr>
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td>
                    <?php if ($item['user_image']): ?>
                        <img src= "/<?php echo $item['user_image']; ?>" style="width:50px;" alt="image">
                    <?php endif; ?>
                    </td>
                    <td><?php echo $item['first_name']." ".$item['last_name'] ?></td>
                    <td><?php echo $item['reason']  ?></td>
                    <td><?php echo $item['agent_description']  ?></td>
                    <td>
                    <div class="btn-group">
                      <a href="/request_accept?id=<?php echo $item['user_id'] ?>" type="button" class="btn btn-sm btn-primary py-2 px-2" style="font-size: 0.9em;">Accept</a>
                      <a href="/request_decline?id=<?php echo $item['user_id'] ?>" type="button" class="btn btn-sm btn-danger py-2 px-2" style="font-size: 0.9em;"> Decline</a>
                    </div>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
        <?php if(empty($item)): ?>
          <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
          <center><strong>No Pending Request</strong></center>
          <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
          </div>
          <?php endif; ?>
        <a href="/admin_dashboard" class="btn  btn-warning">Go back</a>
      </div>
    </div>
    <style>
      .table{table-layout:fixed}

    </style>