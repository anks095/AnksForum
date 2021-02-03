<?php
    echo '<!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login to Ank\'s Forum</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="partial/_handleLogin.php" method="post">
            <div class="modal-body">
            <div class="mb-1">
                <label for="loginemail" class="form-label">Email address</label>
                <!-- <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp" required> -->
                <input type="text" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="loginpassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
            </div>
                <div class="wrapper height-width-400">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>';
    // <div class="mb-3 form-check">
    //             <input type="checkbox" class="form-check-input" id="exampleCheck1">
    //             <label class="form-check-label" for="exampleCheck1">Check me out</label>
    //         </div>
    ?>