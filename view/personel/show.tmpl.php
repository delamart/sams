<h1 class="page-header"><?php _('Personel'); ?> <em><?php echo $this->personel->getFullName(); ?></em></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('personel','index'); ?>" role="button"><?php _('Back to Personel'); ?></a>
    <a class="btn btn-primary" href="<?php eUrl('personel','edit',$this->personel->id); ?>" role="button"><?php _('Edit Personel'); ?></a>
</div>

<br />

<div class="">
    <dl class="dl-horizontal">
        <dt><?php _('Rank'); ?></dt>
        <dd><?php echo $this->personel->getRankName(); ?></dd>
        <dt><?php _('Name'); ?></dt>
        <dd><?php echo $this->personel->name; ?></dd>
        <dt><?php _('Personel Group'); ?></dt>
        <dd><?php echo $this->personel->getPersonelgroupName(); ?></dd>
        <dt><?php _('Tel'); ?></dt>
        <dd><?php echo $this->personel->tel; ?></dd>
        <dt><?php _('Discharged'); ?></dt>
        <dd><?php echo $this->personel->discharged ? dt($this->personel->discharged) : TranslateLib::translateText('no'); ?></dd>
        <dt><?php _('Vehicle Licenses'); ?></dt>
        <dd><?php echo $this->personel->getLicensesFullNames(PersonelModel::WHERE_LICENSE_VEHICLE); ?></dd>
        <dt><?php _('Trailer Licenses'); ?></dt>
        <dd><?php echo $this->personel->getLicensesFullNames(PersonelModel::WHERE_LICENSE_TRAILER); ?></dd>
        <dt><?php _('Personel Checks'); ?></dt>
        <dd>
            <?php foreach($this->personel->getPersonelchecks() as $check): ?>
                <span class="glyphicon glyphicon-check" aria-hidden="true"></span> <?php echo $check->name; ?><br>
            <?php endforeach; ?>
        </dd>
    </dl>
</div>
<h2><?php _('Personel Missions'); ?></h2>
<div class="table-responsive">
    <table id="mission-table" class="table table-striped">
        <thead>
        <tr>
            <th><?php _('Start'); ?></th>
            <th><?php _('End'); ?></th>
            <th><?php _('Vehicle'); ?></th>
            <th><?php _('Summary'); ?></th>
            <th class="text-right"><?php _('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($this->missions as $id => $mission): ?>
            <tr>
                <td data-order="<?php echo $mission->start; ?>"><?php $mission->startHTML(); ?></td>
                <td data-order="<?php echo $mission->end; ?>"><?php $mission->endHTML(); ?></td>
                <td><?php echo $mission->getVehicleFull(); ?></td>
                <td><?php echo $mission->summary; ?></td>
                <td class="text-right">
                    <a href="<?php eUrl('mission','show',$id); ?>" class="btn btn-default btn-xs glyphicon glyphicon-search">
                        <span class="sr-only">Show</span>
                    </a>
                    <a href="<?php eUrl('mission','edit',$id); ?>" class="btn btn-primary btn-xs glyphicon glyphicon-pencil">
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="<?php eUrl('mission','delete',$id); ?>"
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
            $('#mission-table').dataTable();
        } );
    </script>
</div>