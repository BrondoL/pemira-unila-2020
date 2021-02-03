<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/assets/login.js"></script>
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'POST',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });

    function showJurusan(val) {
        if (val == "Keguruan Dan ilmu Pendidikan") {
            document.getElementById("form_jurusan").innerHTML = '<select class="form-select form-control" aria-label="Default select example" name="jurusan"> <option value = "___" > Pilih Jurusan </option> <option value = "Bimbingan Konseling" > Bimbingan Konseling </option> <option value = "Pendidikan Bahasa Dan Sastra Indonesia" > Pendidikan Bahasa Dan Sastra Indonesia </option> <option value = "Pendidikan Bahasa Inggris" > Pendidikan Bahasa Inggris </option> <option value = "Pendidikan Biologi" > Pendidikan Biologi </option> <option value = "Pendidikan Ekonomi" > Pendidikan Ekonomi </option> <option value = "Pendidikan Fisika" > Pendidikan Fisika </option> <option value = "Pendidikan Geografi" > Pendidikan Geografi </option> <option value = "Pendidikan Jasmani, Kesehatan Dan Rekreasi" > Pendidikan Jasmani, Kesehatan Dan Rekreasi </option> <option value = "Pendidikan Kimia" > Pendidikan Kimia </option> <option value = "Pendidikan Matematika" > Pendidikan Matematika </option> <option value = "Pendidikan Pancasila Dan Kewarganegaraan" > Pendidikan Pancasila Dan Kewarganegaraan </option> <option value = "Pendidikan Sejarah" > Pendidikan Sejarah </option> <option value = "Pendidikan Seni Tari" > Pendidikan Seni Tari </option> <option value = "Pendididikan Bahasa Prancis" > Pendididikan Bahasa Prancis </option> <option value = "Pendidikan Anak Usia Dini" > Pendidikan Anak Usia Dini </option> </select>';
        } else {
            document.getElementById("form_jurusan").innerHTML = '<input type="text" class="form-control form-control-user" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan">';
        }
    }
</script>
</body>

</html>