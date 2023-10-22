

<script >
    $(document).ready(function() {
        $('.remove').click(function() {
            $(this).closest('form').find('input[type=text]').val('');
        });
    })
</script>


</head>
<body>


    <div class="container">
        <h1>REGISTER</h1>
        <form action="<?php echo base_url('register') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <?php echo form_input(['name'=>'name', 'placeholder'=>'Name', 'class'=>'form-control', 'value'=>set_value('name')]); ?>
            
                    <small class="text-danger"><?php echo form_error('name');?></small>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <?php echo form_input(['name'=>'email', 'placeholder'=>'Email', 'class'=>'form-control', 'value'=>set_value('email')]); ?>
                    <small class="text-danger"><?php echo form_error('email');?></small>

                </div>
            </div>


            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <?php echo form_input(['name'=>'phone', 'placeholder'=>'Phone', 'class'=>'form-control', 'value'=>set_value('phone')]) ?>
                    <small class="text-danger"><?php echo form_error('phone');?></small>

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
                <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                    <?php echo form_upload(['name'=>'avatar', 'placeholder'=>'Avatar', 'class'=>'form-control-file']); ?>
                    <small class="text-danger"><?php echo form_error('avatar');?></small>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">

                    <?php echo form_submit(['name'=>'submit', 'value'=>'Submit', 'class'=>'btn btn-primary']); ?>
                    <button type="button" class="btn btn-primary remove">Cancel</button>
                </div>
        </form>
    </div>    


