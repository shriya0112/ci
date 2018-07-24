<section id="content">
  <div class="container">
    <div class="row">
      <?php 
      if (isset($this->session->changePasswordFailed)) {
        echo "<div class='text-center text-danger'>".$this->session->changePasswordFailed."</div>";
      }
      ?>
      <?php echo validation_errors('<div class="text-center text-danger"> ', '</div>');?>
      <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <?php 
        $attributes = array('class' => 'loginform', 'id' => 'myform','role' => 'form');
        echo form_open(base_url().'welcome/changePasswordSubmit', $attributes);
        ?>
        <h2>Change Password</h2>
           <div class="form-group">
          <?php //Password Field
          echo form_label('Old Password', 'oldpassword', ['class'=>'sr-only']);
          echo form_password('oldpassword', '', ['id'=>'oldpassword','class'=>'form-control input-lg','placeholder'=>'Old Password']); ?>
        </div>
        <div class="form-group">
          <?php //Password Field
          echo form_label('New Password', 'newpassword', ['class'=>'sr-only']);
          echo form_password('newpassword', '', ['id'=>'newpassword','class'=>'form-control input-lg','placeholder'=>'New Password']); ?>
        </div>
        <div class="form-group">
          <?php //Password Field
          echo form_label('Confirm New Password', 'newpassconf', ['class'=>'sr-only']);
          echo form_password('newpassconf', '', ['id'=>'newpassconf','class'=>'form-control input-lg','placeholder'=>'Confirm New Password']); ?>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-3"><?php echo form_submit('changepwd', 'SAVE', ['class' => 'btn btn-primary btn-block btn-lg','id'=>'changepwd']); ?>
          </div>
        </div>
        <?php echo form_close(); ?>
       
      </div>

    </div>

  </div>
</section>