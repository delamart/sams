<h1 class="page-header"><?php _('Vehicles'); ?></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('vehicle','create'); ?>" role="button">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <?php _('Add Vehicle'); ?>
    </a>
</div>

<div class="table-responsive">
    <table id="vehicle-table" class="table table-striped">
        <thead>
        <tr>
            <th><?php _('Mission'); ?></th>
            <th><?php _('Type'); ?></th>
            <th><?php _('Number'); ?></th>
            <th class="text-right"><?php _('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($this->vehicles as $id => $vehicle): ?>
            <tr>
                <td><?php echo $vehicle->getMissionHTML(); ?></td>
                <td><?php echo $vehicle->getVtypeName(); ?></td>
                <td><?php echo $vehicle->number; ?></td>

                <td class="text-right">
                    <a href="<?php eUrl('vehicle','show',$id); ?>" class="btn btn-default btn-xs glyphicon glyphicon-search">
                        <span class="sr-only">Show</span>
                    </a>
                    <a href="<?php eUrl('vehicle','edit',$id); ?>" class="btn btn-primary btn-xs glyphicon glyphicon-pencil">
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="<?php eUrl('vehicle','delete',$id); ?>"
                       class="btn btn-danger btn-xs glyphicon glyphicon-remove"
                       onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')">
                        <span class="sr-only">Delete</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#vehicle-table').dataTable();
        } );
    </script>
</div>