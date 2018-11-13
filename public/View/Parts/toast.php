<?php if ($return['params']['messages']) { ?>
    <script>
        <?php foreach ($return['params']['messages'] as $error) { ?>
        M.toast({html: "<?= $error['text'] ?>", classes: '<?= ($error['type'] === "success")? "green" : "red" ?> lighten-1'});
        <?php } ?>
    </script>
<?php } ?>