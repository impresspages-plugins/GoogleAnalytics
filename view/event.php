ga(
'send'
, 'event'
, '<?php echo addslashes($category) ?>'
, '<?php echo addslashes($action) ?>'
<?php if (!empty($label)) { ?>, '<?php echo addslashes($label) ?>'<?php } ?>
<?php if (!empty($value))  { ?>, '<?php echo addslashes($value) ?>'<?php } ?>
);

