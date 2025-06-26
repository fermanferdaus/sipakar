<?php 
  include ('../part/header.php');
?>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f3f4f6;
  }

  .card-modern {
    background: #ffffff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.1);
    padding: 30px;
    width: 100%;
    max-width: 420px;
    margin: auto;
  }

  .card-modern h4 {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 25px;
  }

  .form-control {
    border-radius: 10px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
  }

  .form-control:focus {
    box-shadow: 0 0 0 2px #4dabf7;
    border-color: #4dabf7;
  }

  .btn-modern {
    background-color: #4dabf7;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px;
    font-weight: 500;
    transition: background-color 0.3s ease;
  }

  .btn-modern:hover {
    background-color: #339af0;
  }

  .alert {
    font-size: 0.95rem;
  }

</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card-modern">
    <h4 class="text-center"><i class="fas fa-id-card"></i> Cek NIK Anda</h4>

    <?php 
      if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
        echo "<div class='alert alert-danger text-center'>NIK Anda tidak terdaftar. Silahkan hubungi Kantor Desa!</div>";
      }
    ?>

    <form action="info-surat.php" method="post">
      <div class="form-group">
        <label for="fnik"><strong>NIK</strong> <small class="text-muted">(Nomor Induk Kependudukan)</small></label>
        <input 
          type="text" 
          class="form-control" 
          maxlength="16" 
          name="fnik" 
          placeholder="Masukkan NIK Anda..." 
          onkeypress="return hanyaAngka(event)" 
          required
        >
      </div>

      <script>
        function hanyaAngka(evt){
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
          return true;
        }
      </script>

      <button type="submit" class="btn btn-modern btn-block mt-3">
        <i class="fas fa-search"></i> Cek NIK
      </button>
    </form>
  </div>
</div>

<?php 
  include ('../part/footer.php');
?>
