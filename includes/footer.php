<!-- <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Urcadelima</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
              <div class="social-icons">
                <a href="https://www.instagram.com/jean_hounkpati/" class="btn btn-primary btn-lg">
                    <i class="fab fa-facebook"></i>
                  </a>
                  <a href="https://www.instagram.com/jean_hounkpati/" class="btn btn-danger btn-lg">
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a href="https://www.twitter.com/jeanHounkpati/" class="btn btn-info btn-lg">
                    <i class="fab fa-twitter"></i>
                  </a>
              </div>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © 2023, made with <i class="fa fa-heart heart"></i> by Urcadelima
              </span>
            </div>
          </div>
        </div>
</footer> -->
      </div>
  </div>
  <!--   Core JS Files   -->
 <script src="../admin/assets/js/jquery.min.js"></script>
  <script src="../admin//assets/js/popper.min.js"></script>
  <script src="../admin/assets/js/bootstrap.min.js"></script>
  <script src="../admin/assets/js/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../admin/assets/js/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../admin/assets/js/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../admin/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- MY JS FILE -->
  <script src="assets/js/custom.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script>
    <?php if(isset($_SESSION['message'])){?>
      alertify.set('notifier','position', 'top-center');
      alertify.success('<?= $_SESSION['message'];?>');
	  <?php 
    	unset($_SESSION['message']);
    } ?> 
  </script>

  </body>

</html>