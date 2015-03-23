
    <?php if($this->user): ?>
        
        <form action="<?php eUrl('user','logout'); ?>" method="post">
            <button class="">Logout</button>
        </form> 
        
    <?php else: ?>

        <h1>Logout Successfull</h1>
        
    <?php endif; ?>

