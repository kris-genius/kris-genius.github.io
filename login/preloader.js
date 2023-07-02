// Menunjukkan preloader saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    var preloader = document.querySelector('.preloader');
    preloader.style.display = 'block';
  
    // Menyembunyikan preloader setelah beberapa waktu (misalnya, 3 detik)
    setTimeout(function() {
      preloader.style.display = 'none';
    }, 500);
  });
  