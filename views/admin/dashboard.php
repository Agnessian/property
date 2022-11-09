
    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:1vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mb-5">
            <h1 class="heading" data-aos="fade-up">Dashboard</h1>
            <h3 class="text-white mb-5" data-aos="fade-up">
                      Welcome Admin <?php echo ucwords($_SESSION['first_name'] ." ".$_SESSION['last_name']) ;?>
                  </h3>
          </div>
        </div>
      </div>
    </div>
<?php if(isset($_SESSION['roleId'])) :?>
  <?php if($_SESSION['roleId'] == 2): ?>
    <section class="features-1">
      <div class="container">
        <div class="row">
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature">
              <span class="flaticon-house"></span>
              <h3 class="mb-3">All Properties</h3>
              <p class="size">
                This includes all properties that are sold,
                for sale and for rent etc.
              </p>
              <p><a href="/properties" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature">
              <span><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" style="height: 69px;" viewBox="0 0 512 512">
                <title>Add Agents</title>
                <path d="M376 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="15"/>
                <path d="M288 304c-87 0-175.3 48-191.64 138.6-2 10.92 4.21 21.4 15.65 21.4H464c11.44 0 17.62-10.48 15.65-21.4C463.3 352 375 304 288 304z" fill="none" stroke="#00204a" stroke-miterlimit="10" stroke-width="15"/>
                <path fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="15" d="M88 176v112M144 232H32"/></svg></span>
              <h3 class="mb-3">Agents Request</h3>
              <p class="size">
                Review all agent requests.
                Add agents to our wonderful list of agents
              </p>
              <p><a href="/agent_request" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box-feature">
              <span class="flaticon-house-3"></span>
              <h3 class="mb-3">All Users</h3>
              <p class="size">
                This includes all the agents and default Users with their respective details and properties.
              </p>
              <p><a href="/users" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box-feature">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" style="height: 69px;" viewBox="0 0 512 512">
              <title>Settings</title>
              <path d="M262.29 192.31a64 64 0 1057.4 57.4 64.13 64.13 0 00-57.4-57.4zM416.39 256a154.34 154.34 0 01-1.53 20.79l45.21 35.46a10.81 10.81 0 012.45 13.75l-42.77 74a10.81 10.81 0 01-13.14 4.59l-44.9-18.08a16.11 16.11 0 00-15.17 1.75A164.48 164.48 0 01325 400.8a15.94 15.94 0 00-8.82 12.14l-6.73 47.89a11.08 11.08 0 01-10.68 9.17h-85.54a11.11 11.11 0 01-10.69-8.87l-6.72-47.82a16.07 16.07 0 00-9-12.22 155.3 155.3 0 01-21.46-12.57 16 16 0 00-15.11-1.71l-44.89 18.07a10.81 10.81 0 01-13.14-4.58l-42.77-74a10.8 10.8 0 012.45-13.75l38.21-30a16.05 16.05 0 006-14.08c-.36-4.17-.58-8.33-.58-12.5s.21-8.27.58-12.35a16 16 0 00-6.07-13.94l-38.19-30A10.81 10.81 0 0149.48 186l42.77-74a10.81 10.81 0 0113.14-4.59l44.9 18.08a16.11 16.11 0 0015.17-1.75A164.48 164.48 0 01187 111.2a15.94 15.94 0 008.82-12.14l6.73-47.89A11.08 11.08 0 01213.23 42h85.54a11.11 11.11 0 0110.69 8.87l6.72 47.82a16.07 16.07 0 009 12.22 155.3 155.3 0 0121.46 12.57 16 16 0 0015.11 1.71l44.89-18.07a10.81 10.81 0 0113.14 4.58l42.77 74a10.8 10.8 0 01-2.45 13.75l-38.21 30a16.05 16.05 0 00-6.05 14.08c.33 4.14.55 8.3.55 12.47z" fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="10"/>
            </svg>
              <h3 class="mb-3">Settings</h3>
              <p class="size">
              You can update your profile, reset password etc. 
              </p>
              <p><a href="/settings" class="learn-more">View All</a></p>
              
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endif; ?>
<?php endif; ?>
    