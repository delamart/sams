<h1 class="page-header"><?php _('Edit'); ?> <em><?php echo $this->vehicle->getVtypeName(); ?> <?php echo $this->vehicle->number; ?></em></h1>

<form action="<?php eUrl('vehicle','edit',$this->vehicle->id); ?>" method="post">

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
                <option <?php echo ($this->vehicle->vtype_id == $id)?'selected="selected"':'' ?> value="<?php echo $id; ?>"><?php echo $vtype->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="number"><?php _('Number'); ?></label>
        <input name="number" type="text" class="form-control" id="number" placeholder="M+>" value="<?php ePost('number',$this->vehicle->number); ?>">
    </div>
    <div class="form-group">
        <label for="image"><?php _('Image'); ?></label>
        <input type="file" id="image" name="image">
        <p class="help-block">Image au format png,gif ou jpeg.</p>
    </div>


    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('vehicle','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Edit'); ?></button>
    </div>
</form>