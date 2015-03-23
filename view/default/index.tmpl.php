<h1 class="page-header"><?php _('Overview'); ?></h1>

<div id="visualization"></div>

<script>
    var now = new Date();

    // create a data set with groups
    var groups = new vis.DataSet();
    <?php foreach($this->vehicles as $id => $vehicle): ?>
    groups.add({
        id: <?php echo $id; ?>,
        content: '<?php echo addslashes($vehicle->getFullName()); ?>'
    });
    <?php endforeach; ?>

    // create a dataset with items
    var items = new vis.DataSet();
    <?php foreach($this->missions as $id => $mission): ?>
    items.add({
        id: <?php echo $id; ?>,
        start: '<?php echo date('Y-m-d H:i:s',$mission->start); ?>',
        end: '<?php echo date('Y-m-d H:i:s',$mission->end); ?>',
        group: <?php echo $mission->vehicle_id; ?>,
        content: '<?php echo addslashes($mission->summary); ?>'
    });
    <?php endforeach; ?>

    // create visualization
    var container = document.getElementById('visualization');
    var options = {
        start: '<? echo date('Y-m-d H:i:s',strtotime('-1 hour')); ?>',
        end: '<? echo date('Y-m-d H:i:s',strtotime('+9 hour')); ?>',
        min: '2015-03-02 00:00:00',
        max: '2015-03-27 23:59:59',
        zoomMin: 60000, // minimum 1minute (60000ms)
        orientation: 'both',
        groupOrder: 'content' // groupOrder can be a property name or a sorting function

    };

    var timeline = new vis.Timeline(container);
    timeline.setOptions(options);
    timeline.setGroups(groups);
    timeline.setItems(items);

</script>