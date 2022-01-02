<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#"><?php echo $this->data['company_name']?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <?php if( isset($this->data['user_data']) ):?>
          <li><a class="nav-link" href="<?php echo base_url('users/profile')?>">Profile</a></li>
        <?php endif?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('landing/index')?>">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <?php if( isset( $_SESSION['cart_token']) ):?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('cart/index')?>">Cart</a>
          </li>
        <?php endif?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search" name="key_word">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
      <?php if( !isset($this->data['user_data']) ):?>
        &nbsp;
        <a href="<?php echo base_url('auth/login')?>" class="btn btn-warning">Login</a>
        &nbsp;
        <a href="<?php echo base_url('users/register')?>" class="btn btn-warning">register</a>
      <?php endif?>
    </div>
  </div>
</nav>