<?php
    echo '<!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel">Signup to Ank\'s forum</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="partial/_handleSignup.php" method="post">
            <div class="modal-body">
                <div class="mb-1">
                    <label for="signupEmail1" class="form-label">Username</label>
                    <!-- <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required> -->
                    <input type="text" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
                    <!-- <div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div> -->
                </div>
                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="signupPassword" name="signupPassword" required>
                    <div id="emailHelp" class="form-text">maxlength is 30</div>
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                    <div id="emailHelp" class="form-text">Re-type the password</div>
                </div>
                <div class="d-grid d-md-block">
                    <button type="submit" class="btn btn-primary" style="min-width:80px">SignUp</button>
                    <button type="reset" class="btn btn-primary" style="min-width: 80px">Reset</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>'
?>