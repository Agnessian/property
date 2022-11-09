<div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:40vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mb-5">
            <h1 class="heading">All  Request</h1>
            <ol class="breadcrumb text-center justify-content-center">
              <li class="breadcrumb-item h6"><em><a class="text-white" href="#pending">Pending Request</a></em></li>
              <li class="breadcrumb-item h6"><em><a class="text-white" href="#declined">Declined Request</a></em></li>
              <li class="breadcrumb-item h6"><em><a class="text-white" href="#Accepted">Accepted Request</a></em></li>
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
      <section id="accepted">
        <table class="table caption-top table-sm table-striped">
            <caption class="h3 mb-4">List of Accecpted Requests</caption>
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
              <?php if ($item['status']==2): ?>
                <tr>
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td>
                    <?php if ($item['user_image']): ?>
                        <img src= "/<?php echo $item['user_image']; ?>" style="width:60px;" alt="image">
                    <?php endif; ?>
                    </td>
                    <td><?php echo $item['first_name']." ".$item['last_name'] ?></td>
                    <td><?php  echo $item['reason']  ?></td>
                    <td><?php  echo $item['agent_description']  ?></td>
                    <td>
                    <a href="/request_decline?id=<?php echo $item['user_id'] ?>" type="button" class="btn btn-sm btn-danger py-2 px-2" style="font-size: 0.9em;"> Decline</a>
                </td>
                </tr>
              <?php endif; ?>
           <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
      </section>
        
      <section id="declined">
          <table class="table caption-top table-sm table-striped">
            <caption class="h3 mb-4">List of Declined Requests</caption>
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
              <?php if ($item['status']==3): ?>
                <tr>
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td>
                    <?php if ($item['user_image']): ?>
                        <img src= "/<?php echo $item['user_image']; ?>" style="width:60px;" alt="image">
                    <?php endif; ?>
                    </td>
                    <td><?php echo $item['first_name']." ".$item['last_name'] ?></td>
                    <td><?php  echo $item['reason']  ?></td>
                    <td><?php  echo $item['agent_description']  ?></td>
                    <td>
                      <a href="/request_accept?id=<?php echo $item['user_id'] ?>" type="button" class="btn btn-sm btn-primary py-2 px-2" style="font-size: 0.9em; font-weight:400;">Accept</a>
                    </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
      </section>

      <section id="pending">
        <table class="table caption-top table-sm table-striped">
            <caption class="h3 mb-4">List of Pending Requests</caption>
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
              <?php if ($item['status']==1): ?>
                <tr>
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td>
                    <?php if ($item['user_image']): ?>
                        <img src= "/<?php echo $item['user_image']; ?>" style="width:60px;" alt="image">
                    <?php endif; ?>
                    </td>
                    <td><?php echo $item['first_name']." ".$item['last_name'] ?></td>
                    <td><?php  echo $item['reason']  ?></td>
                    <td><?php  echo $item['agent_description']  ?></td>
                    <td>
                    <div class="btn-group">
                      <a href="/request_accept?id=<?php echo $item['user_id'] ?>" type="button" class="btn btn-sm btn-primary py-2 px-2" style="font-size: 0.9em;">Accept</a>
                      <a href="/request_decline?id=<?php echo $item['user_id'] ?>" type="button" class="btn btn-sm btn-danger py-2 px-2" style="font-size: 0.9em;"> Decline</a>
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
           <?php endforeach; ?>
            </tbody>
        </table>
                      <hr>
      </section>

        <a href="/agent_request" class="btn  btn-warning">Go back</a>
      </div>
    </div>
    <style>
      .table{table-layout:fixed}

    </style>