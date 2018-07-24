<div class="container">
    <?php 
    if (isset($this->session->loginFailed)) {
        echo "<div class='text-danger'>".$this->session->loginFailed."</div>";
    }
    ?>
    <?php echo validation_errors('<div class="text-danger">', '</div>'); ?>
    <form action="" method="post">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email">Email<span>*</span></label>
                <input type="text" class="form-control" name ="email" id="email" value="" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password">Password<span>*</span></label>
                <input type="password" class="form-control" id="password" name="password" value="" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <button class="btn btn-primary" type="submit">Sign in</button>
            </div>
        </div>
    </form>
</div>
