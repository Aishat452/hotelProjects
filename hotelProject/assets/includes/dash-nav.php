<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">
        <img src="../assets/img/logo.png" height="60" alt="log">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <div class="nav-link input-group">
              <button class="btn btn-outline-light rounded-pill btn-sm text-dark d-none" id="lightmode">Light</button>
              <button class="btn btn-outline-dark rounded-pill btn-sm" id="darkmode">Dark</button>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reservations">Reservations</a>
        </li>
        <?php if ($_SESSION['role']  != 'admin') { ?>
          <li class="nav-item">
            <a class="nav-link" href="settings">Settings</a>
          </li>
        <?php } ?>
        
        <li class="nav-item">
          <a class="nav-link" href="../assets/config/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
