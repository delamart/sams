          <h1 class="page-header"><?php _('Account'); ?> <em><?php echo $this->user->name; ?></em></h1>

					<form action="<?php eUrl('user','logout'); ?>" method="post" class="text-right">
							<button class="btn btn-danger"><?php _('Logout'); ?></button>
					</form>                       

					<form action="<?php eUrl('user','index'); ?>" method="post">
            
            <?php if(count($this->errors)): ?>
            <div class="">
                <ul>
                <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>    
                </ul>
            </div>
            <?php endif; ?>
					
						<div class="form-group">
							<label for="name"><?php _('Name'); ?></label>
							<input name="name" type="text" class="form-control" id="name" placeholder="<?php _('Enter Name'); ?>" value="<?php ePost('name',$this->user->name); ?>" />
						</div>
						<div class="form-group">
							<label for="password"><?php _('Password'); ?></label>
							<input name="password" type="password" class="form-control" id="password" placeholder="****" />
						</div>
						<div class="form-group">
							<label for="password2"><?php _('Confirm password'); ?></label>
							<input name="password2" type="password" class="form-control" id="password2" placeholder="****" />
						</div>
					
						<div class="text-right">
							<button type="submit" class="btn btn-primary"><?php _('Save'); ?></button>
						</div>
					</form>