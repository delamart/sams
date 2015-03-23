        
    <?php if($this->user): ?>
        <h1>
        Login Successfull as
        <?php echo $this->user->name; ?>
        </h1>
    <?php else: ?>
        
        <?php if(count($this->errors)): ?>
        <div class="with-margin error">
            <ul>
            <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>    
            </ul>
        </div>
        <?php endif; ?>
        
				<div class="well well-lg">
        <form action="<?php eUrl('user','login'); ?>" method="post" class="form-inline text-center" >
					<div class="form-group">
							<label for="username"><?php _('Username'); ?></label> 
							<input id="username" type="text" name="username" value="<?php echo ePost('email'); ?>" placeholder="user"/> 
					</div>
					<div class="form-group">
							<label for="password"><?php _('Password'); ?></label> 
							<input id="password" type="password" name="password" value="<?php echo ePost('password'); ?>" placeholder="******" /> 
					</div>            
					<button class="btn btn-primary" type="submit">Login</button>            
        </form>
        
    <?php endif; ?>
