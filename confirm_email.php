<?php
include 'partials/_header.php';
if (filter_input_array(INPUT_GET) !== null) {
    $email_activation_key = filter_input(INPUT_GET, 'email_activation_key');
    $email = filter_input(INPUT_GET, 'email');
    ?>
    <script type="text/javascript">
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "operations/user_operations.php",
            data: {
                op: 6,
                email: '<?php echo $email; ?>',
                email_activation_key: '<?php echo $email_activation_key; ?>'
            },
            success: function (result) {
                if (result.success) {
                    $('#alert-danger').hide();
                    $('#alert-success').html('Email aktivasyonu başarıyla yapıldı. Birkaç saniye sonra kullanıcı giriş sayfasına yönlendirileceksiniz...');
                    $('#alert-success').show();
                    sleep(5000).then(() => {
                        window.location = 'login.php';
                    });
                } else {
                    $('#alert-success').hide();
                    $('#alert-danger').html('Email aktivasyonu sırasında hata oluştu! Lütfen daha sonra tekrar deneyiniz...');
                    $('#alert-danger').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            }
        });
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    </script>
    <div id="alert-danger" class="alert alert-danger text-center mt-2" style="display:none"></div>
    <div id="alert-success" class="alert alert-success text-center mt-2" style="display:none"></div>
    <?php
}
?>
<?php
include 'partials/_footer.php';
?>