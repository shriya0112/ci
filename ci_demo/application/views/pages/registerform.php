<section id="content">
  <div class="container">
    <div class="row">
      <?php 
      if (isset($this->session->loginFailed)) {
        echo "<div class='text-center text-danger'>".$this->session->loginFailed."</div>";
      }
      ?>
      <?php echo validation_errors('<div class="text-center text-danger"> ', '</div>');?>
      <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <?php 
        $attributes = array('class' => 'loginform', 'id' => 'myform','role' => 'form');
        echo form_open(base_url().'welcome/registerSubmit', $attributes);
        ?>
        <h2>Create New Account</h2>
        <div class="form-group">
          <?php 
          $firstnameOptions = ['type'=>'text','name'=>'firstname','id'=>'firstname','placeholder'=>'First Name','class'=>'form-control  input-lg', 'tabindex'=>'4'];
          //Email Field
          echo form_label('First Name', 'username', ['class'=>'sr-only']);
          echo form_input($firstnameOptions); ?>
        </div>
                <div class="form-group">
          <?php 
          $lastnameOptions = ['type'=>'text','name'=>'lastname','id'=>'lastname','placeholder'=>'Last Name','class'=>'form-control  input-lg', 'tabindex'=>'4'];
          //Email Field
          echo form_label('Last Name', 'lastname', ['class'=>'sr-only']);
          echo form_input($lastnameOptions); ?>
        </div>
        <div class="form-group">
          <?php 
          $emailOptions = ['type'=>'email','name'=>'email','id'=>'email','placeholder'=>'Email Address','class'=>'form-control  input-lg', 'tabindex'=>'4'];
          //Email Field
          echo form_label('Email', 'email', ['class'=>'sr-only']);
          echo form_input($emailOptions); ?>
        </div>
        <div class="form-group">
          <?php //Password Field
          echo form_label('Password', 'password', ['class'=>'sr-only']);
          echo form_password('password', '', ['id'=>'password','class'=>'form-control input-lg','placeholder'=>'Password']); ?>
        </div>
        <div class="form-group">
          <?php //Password Field
          echo form_label('Confirm Password', 'passconf', ['class'=>'sr-only']);
          echo form_password('passconf', '', ['id'=>'passconf','class'=>'form-control input-lg','placeholder'=>'Confirm Password']); ?>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-3"><?php echo form_submit('register', 'Register', ['class' => 'btn btn-primary btn-block btn-lg','id'=>'register']); ?>
          </div>
        </div>
        <?php echo form_close(); ?>
         <a href="<?php echo base_url();?>welcome/login" class="pull-right">Already have a account ? Login here</a>
      </div>

    </div>

  </div>
</section>