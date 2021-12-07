  <div class="row">
    <div class="col-md-7">
      <object data="<?php echo base_url().$toc_file['full_path']?>" style="width: 100%; height:100vh"></object>
    </div>


    <div class="col-md-5">
      <div class="container">
        <div class="mt-5"></div>
        <form method="post">
          <h3>Before you can use the full-features of our ordering-platform
            you must agree to our terms and conditions fist.</h3>
          <div class="form-group">
            <label>
              <input type="checkbox" name="cbox-agreement-to-terms" required>
              I Agree to the terms and agreements of this platform.
            </label>
          </div>

          <div class="form-group mt-3">
            <input type="submit" name="" class="btn btn-primary" value="Agree to terms">
          </div>
        </form>
      </div>
    </div>
  </div>