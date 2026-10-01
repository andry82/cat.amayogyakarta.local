	<footer class="page-footer mt-auto bg-light">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
		  	<span class="text-muted">
				<span class="fa-stack fa-lg d-none" id="online">
					<i class="fa fa-wifi text-success fa-stack-1x"></i>
         		</span>
				<span class="fa-stack fa-lg d-none" id="offline">
				  <i class="fa fa-wifi fa-stack-1x"></i>
				  <i class="fa fa-ban fa-stack-2x text-danger"></i>
				</span>
				<span ondblclick="downloadJawaban();">Copyright&copy; 2025</span>
				<span id="socketStatus-X" class="fa-stack fa-lg text-danger d-none">
			  		<i class="fa fa-exclamation-triangle"></i>
         		</span>
			</span>
          </div>
        </div>
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=$theme_url;?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=$theme_url;?>js/bootstrap.bundle.min.js"></script>
    <script src="<?=$theme_url;?>js/notify.min.js"></script>

	<script>
		let isOnline, wsConnected = false;

		var myHeaders = new Headers();

		myHeaders.append('pragma', 'no-cache');
		myHeaders.append('cache-control', 'no-cache');

		var myInit = {
		  method: 'GET',
		  headers: myHeaders,
		};

		const checkOnlineStatus = async () => {
		  try {
		    const online = await fetch("<?= base_url('themes/simple/images/1x1-00000000.png')?>", myInit);
		    return online.status >= 200 && online.status < 300; // either true or false
		  } catch (err) {
		    return false; // definitely offline
		  }
		};

		window.addEventListener("load", async (event) => {
		    isOnline = await checkOnlineStatus();
			toggleStatus();
		});

		window.addEventListener('offline', function(e) {
			isOnline = false;
    		//console.log('Network disconnected');
		});

		window.addEventListener('online', function(e) {
			isOnline = true;
			//console.log('Network connected');
		});

		function toggleStatus(){
			if (isOnline) {
				$('#online').removeClass('d-none');
				$('#offline').addClass('d-none');
			} else {
				$('#online').addClass('d-none');
				$('#offline').removeClass('d-none');
			}

			if (wsConnected) {
				$('#socketStatus').addClass('d-none');
			} else {
				$('#socketStatus').removeClass('d-none');
			}
		}

		/* View in fullscreen */
		function openFullscreen(elem) {
		  if (elem.requestFullscreen) {
		    elem.requestFullscreen();
		  } else if (elem.webkitRequestFullscreen) { /* Safari */
		    elem.webkitRequestFullscreen();
		  } else if (elem.msRequestFullscreen) { /* IE11 */
		    elem.msRequestFullscreen();
		  }
		}

		/* Close fullscreen */
		function closeFullscreen() {
		  if (document.exitFullscreen) {
		    document.exitFullscreen();
		  } else if (document.webkitExitFullscreen) { /* Safari */
		    document.webkitExitFullscreen();
		  } else if (document.msExitFullscreen) { /* IE11 */
		    document.msExitFullscreen();
		  }
		}
	</script>

	<?php \Arifrh\Themes\Themes::renderJS(); ?>
	
  </body>
</html>