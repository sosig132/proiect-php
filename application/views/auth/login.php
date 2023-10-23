
</head>
<body>
<?php //echo validation_errors(); ?>
    <div class="container">
        <h1>LOGIN</h1>
        <form action="<?php echo base_url('login') ?>" method="POST">
            
            <?php 
                echo $this->session->flashdata('login_failed');
            ?>
            <div class="form-group">
                <label for="emailphone" class="col-sm-2 control-label">Email/Phone</label>
                <div class="col-sm-10">
                    <?php echo form_input(['name'=>'emailphone', 'placeholder'=>'Email/Phone', 'class'=>'form-control']); ?>
                    <small class="text-danger"><?php echo form_error('emailphone');?></small>

                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <?php echo form_password(['name'=>'password', 'placeholder'=>'Password', 'class'=>'form-control']); ?>
                    <small class="text-danger"><?php echo form_error('password');?></small>

                </div>
            </div> 

            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">

                    <?php echo form_submit(['name'=>'submit', 'value'=>'Submit', 'class'=>'btn btn-primary']); ?>
                    <a href="http://localhost/proiect/index.php/register" class="btn btn-primary">Go to register</a>
                </div>
        </form>
    </div>    


