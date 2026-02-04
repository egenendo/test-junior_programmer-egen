</div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/templates') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/templates') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/templates') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/templates') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/templates') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/templates') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets/templates') ?>/dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(function (){
    $('.select2').select2()
  });

  function isNumber(evt) {
      var hargaInput = document.getElementsByName("harga")[0];
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          var errorElement = document.createElement('div');
          errorElement.className = 'text-small text-danger';
          errorElement.innerHTML = 'isi dengan angka !';
          hargaInput.parentNode.appendChild(errorElement);

          if (hargaInput.parentNode) {
            hargaInput.parentNode.appendChild(errorElement);
          }
          
          return false;
      }
      return true;
  }
  $(document).ready(function() {
    $('.number').keypress(function (e) {
      $('.text-small.text-danger').remove();
      if (!isNumber(e)) {
        e.preventDefault();
      }
      
    });
  });
  $(document).on('click', '.btn-hapus', function(e) {
      e.preventDefault();
      
      const id = $(this).data('id');
      const nama = $(this).data('nama');

      Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Produk (" + nama + ") akan dihapus secara permanen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = "<?= base_url('produk/delete/') ?>" + id;
          }
      });
  });
</script>
</body>
</html>