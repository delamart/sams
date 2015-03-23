<h1 class="page-header"><?php _('Personel'); ?></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('personel','create'); ?>" role="button">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <?php _('Add Personel'); ?>
    </a>
    <!--
    <a class="btn btn-default" href="<?php eUrl('personel','import'); ?>" role="button">
        <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
        <?php _('Import Personel'); ?>
    </a>
    -->
    <a class="btn btn-default" href="<?php eUrl('personel','export'); ?>" role="button">
        <span class="glyphicon glyphicon-export" aria-hidden="true"></span>
        <?php _('Export CSV'); ?>
    </a>
</div>

<div class="table-responsive">
    <table id="personel-table" class="table table-striped">
        <thead>
        <tr>
            <th><?php _('Mission'); ?></th>
            <th><?php _('Rank'); ?></th>
            <th><?php _('Name'); ?></th>
            <th><?php _('Personel Group'); ?></th>
            <th><?php _('Tel'); ?></th>
            <th><?php _('Licenses'); ?></th>
            <th class="text-right"><?php _('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($this->personels as $id => $personel): ?>
            <tr>
                <td><?php echo $personel->getMissionHTML(); ?></td>
                <td data-sort="<?php echo $personel->getRankOrder(); ?>"
                    data-search="<?php echo $personel->getRankName().'|'.$personel->getRankShort(); ?>"
                    ><?php echo $personel->getRankShort(); ?></td>
                <td data-search="<?php echo $personel->getSearchName(); ?>"><?php echo $personel->name; ?></td>
                <td><?php echo $personel->getPersonelgroupShort(); ?></td>
                <td><?php echo $personel->tel; ?></td>
                <td data-search="<?php echo $personel->getLicensesFullNames(); ?>" title="<?php echo $personel->getLicensesFullNames(); ?>">
                    <?php echo $personel->getLicensesNames(); ?>
                </td>
                <td class="text-right">
                    <a href="<?php eUrl('personel','show',$id); ?>" class="btn btn-default btn-xs glyphicon glyphicon-search">
                        <span class="sr-only">Show</span>
                    </a>
                    <a href="<?php eUrl('personel','edit',$id); ?>" class="btn btn-primary btn-xs glyphicon glyphicon-pencil">
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="<?php eUrl('personel','delete',$id); ?>"
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
            $('#personel-table').dataTable();
        } );
    </script>
</div>
