<?php $foo = '23'; ?>
<?php die(var_dump($_POST)); ?>
<script>
    console.log(<?php echo json_encode($foo2); ?>);
</script>