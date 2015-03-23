<h1 class="page-header"><?php _('New Vehicle'); ?></h1>

<form action="<?php eUrl('vehicle','create'); ?>" method="post">

    <?php if(count($this->errors)): ?>
        <div class="">
            <ul>
                <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="vtype_id"><?php _('Type'); ?></label>
        <select id="vtype_id" name="vtype_id" class="form-control">
            <?php foreach($this->vtypes as $id => $vtype): ?>
                <option value="<?php echo $id; ?>"><?php echo $vtype->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="number"><?php _('Number'); ?></label>
        <input name="number" type="text" class="form-control" id="number" placeholder="M+">
    </div>

    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('vehicle','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Create'); ?></button>
    </div>
</form>