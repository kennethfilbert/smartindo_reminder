<!DOCTYPE html>
<html>
<head>
    <title>Input New Payment</title>
    <?php
        echo $js;
        echo $css;
    ?>
    <nav class="navbar navbar-expand-sm fixed-top" >
        <div class="container-fluid">
            <h1 class="navbar-brand">Input New Payment</h1>
            <?php
                echo '<ul class="navbar-nav ml-auto">';
                    echo '<li class="nav-item" style="margin: 0px 10px 0px 10px">';
                        echo '<a class="nav-link btn btn-primary" href="'.base_url().'index.php/UserAction/homepage','">';
                        echo '<span class="fa fa-home"></span>';
                            echo '  Home';
                        echo '</a>';
                        echo '<a class="nav-link btn btn-danger" href="'.base_url().'index.php/UserAction/logout','">';
                        echo '<span class="fa fa-power-off"></span>';
                            echo '  Logout';
                        echo '</a>';
                    echo '</li>';
                echo '</ul>';
            ?>
        </div>
    </nav>
</head>
<body>
<h3 style="text-align: center; margin-top: 5%;">Input new payment</h3>
    <?php
        if(!empty($success_msg)){
            echo '<p class="statusMsg">'.$success_msg.'</p>';
        }elseif(!empty($error_msg)){
            echo '<p class="statusMsg">'.$error_msg.'</p>';
        }
    ?>
<div class="container" style="margin-top: 2%;">
    <hr>
     <?php echo form_open('UserAction/addNewPayment/'.$loggedInAdmin); ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="client_id">Payment For Client #ID</label>
            <input type="number" class="form-control" name="client_id" required="">
          <?php echo form_error('client_id','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
        <label for="payment_date">Payment Date</label>
            <input type="date" class="form-control" name="payment_date" required="">
          <?php echo form_error('payment_date','<span class="help-block">','</span>'); ?>
        </div>
        
        <div class="form-group">
            <input type="submit" name="confirm" class="btn-primary" value="Submit"/>
        </div>
    </form>
    <?php echo form_close(); ?>
    <p class="footInfo"><a href="<?php echo base_url(); ?>index.php/UserAction/manageClient">View Client List</a></p>
    <p class="footInfo"><a href="<?php echo base_url(); ?>index.php/UserAction/managePaymentMtc">Return to payment management</a></p>

</div>

</body>
</html>