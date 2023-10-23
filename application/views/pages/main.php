


</head>
<body style = "height:100%">
    <?php 
        //getting authenticated user_id to check if he has a delete button

        $auth_userdetails = $this->session->userdata('auth_user');
        $user_id = $auth_userdetails['id'];
        
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="btn btn-primary m-3" href="<?= base_url('logout'); ?>">Logout</a>
    </nav>


    <div class="container ">    
        
        <form action ="<?= base_url('main') ?>" method="POST">
            <small class="text-danger">
                <?php  
                    echo $this->session->flashdata('message_failed'); 
                ?>
            </small>
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Post a message</label>
                <div class = "col-sm-10">
                    <?php echo form_textarea(['name'=>'content', 'placeholder'=>'Your message', 'class'=>'form-control', 'value'=>set_value('content')]); ?>
                    <small class="text-danger"><?php echo form_error('content');?></small>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">

                    <?php echo form_submit(['name'=>'submit', 'value'=>'Submit', 'class'=>'btn btn-primary']); ?>
                </div>
            </div>
        </form>
        <h1>Messages</h1>
        <ul class="list-unstyled">
            <?php foreach ($messages as $message): ?>
                <?php 
                            $imageFilename = $message->avatar;
                            $imagePath = "../uploads/" . $imageFilename ?>
                <li class="media border p-3 mb-3">
                    <img src="<?php echo $imagePath; ?>" class=" mr-3 rounded-circle" alt="User Avatar" width="50" height="50">
                    <div class="media-body">
                        <h5 class="mt-0"><?= $message->name; ?></h5>
                        <?= $message->content; ?>
                        <small class="text-muted font-italic"><?= $message->created_at; ?></small>
                        
                        
                    </div>
                    <?php if ($message->user_id == $user_id): ?>
                        <a class="delete-link btn btn-danger" href="<?= base_url('delete_message/' . $message->id); ?> " style = "top:0;">Delete</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
