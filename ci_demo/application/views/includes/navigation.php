  <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
            
                <?php if (isset($_SESSION['email'])): ?>

                    <li class="dropdown">
                        <a href="<?php echo base_url();?>welcome/myaccount" style=" padding-right:0; display: inline; ">My Account</a>
                        <button style="margin-top: 9px;" class="dropdown-toggle"  data-toggle="dropdown" ><span class="caret"></span> </button>
                        <ul class="dropdown-menu">

                            <li><a href="<?php echo base_url();?>welcome/changePassword">Change Password</a></li>
                             <li><a href="<?php echo base_url();?>welcome/logout">Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url();?>welcome/logout">Logout</a></li>
                </ul>
            <?php  else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url();?>welcome/register">Sign Up</a></li>
                    <li><a href="<?php echo base_url();?>welcome/login">Login</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav> 
