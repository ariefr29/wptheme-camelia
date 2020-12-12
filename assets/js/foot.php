<noscript>
  <style>
    .artikel, .sidbox, .b-radius {display: none !important}
    .entry-content {visibility: hidden}
    .row {
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
  </style>
</noscript><!-- style for disable JS in browser -->

<?php if (is_singular('post')) { ?>
<script>
  /* Background Tab Option */
  function bgModus(toggleClass) {
    switch (toggleClass) {
      case 'dark':
        $("body").classList.add('dark');
        $("body").classList.remove('light');
        $("body").classList.remove('sepia');
        localStorage.setItem('theme', toggleClass);
        break;
      case 'sepia':
        $("body").classList.add('sepia');
        $("body").classList.remove('light');
        $("body").classList.remove('dark');
        break;
      case 'light':
        $("body").classList.add('light');
        $("body").classList.remove('dark');
        $("body").classList.remove('sepia');
        localStorage.setItem('theme', toggleClass);
        break;
    }
    localStorage.setItem('bg-modus', toggleClass);
  }
  /** get Chache Background Tab Option */
  if (localStorage.getItem('bg-modus') == 'sepia') {
    $("body").classList.add('sepia');
    $("body").classList.remove('light');
    $("body").classList.remove('dark');
  } if (localStorage.getItem('bg-modus') == 'dark') {
    $("body").classList.add('dark');
    $("body").classList.remove('light');
    $("body").classList.remove('sepia');
  } if (localStorage.getItem('bg-modus') == 'light') {
    $("body").classList.add('light');
    $("body").classList.remove('dark');
    $("body").classList.remove('sepia');
  }
</script>
<?php } ?>

<?php if (is_front_page() || is_home()) { ?>
<script>
  if (document.getElementById("slides")) {
    var slides = document.querySelectorAll('#slides .slide');
    var currentSlide = 0;
    var slideInterval = setInterval(nextSlide,5000);

    function nextSlide(){
      slides[currentSlide].className = 'slide';
      currentSlide = (currentSlide+1)%slides.length;
      slides[currentSlide].className = 'slide showing';
    }
  }
</script>
<?php } ?>