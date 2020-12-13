<style>
<?php # custom color 
  $bg_body = (get_option('set_color_background')) ? get_option('set_color_background') : '#f0f2f5' ;
  $bg_header = (get_option('set_color_header')) ? get_option('set_color_header') : '#A62D59' ;
  $primary_color = (get_option('set_color_primary')) ? get_option('set_color_primary') : '#A62D59' ;
  $primary_darkcolor = (get_option('set_color_primary_dark')) ? get_option('set_color_primary_dark') : '#731F5C' ;
?>
  :root {
    --max-width: 980px;
    --font-family-arvo: 'Zilla Slab', serif;
    --font-family-mali: 'Mali', cursive;
    --font-family-nunito: 'Nunito', sans-serif;
    --font-family-open-sans: 'Open Sans', sans-serif;
    --font-family-ubuntu: 'Ubuntu', sans-serif;
    --font-family-ubuntu-mono: 'Ubuntu Mono', monospace;
    --bg-body:<?= $bg_body ?>;
    --bg-header:<?= $bg_header ?>;
    --bg-boxed:#fff;
    --color-text:#2f2f2f;
    --color-text-light:#777;
    --color-text-dark:#121212;
    --color-white:#fff;
    --color-primary:<?= $primary_color ?>;
    --color-primary-dark:<?= $primary_darkcolor ?>;
    --color-yellow:#ffc477;
    --box-shadow:0 2px 6px 0 rgba(0,0,0,.25);
    --box-shadow-light:0 3px 5px 0 rgba(0,1,1,.1);
    --opacity-white:rgba(215,215,215,.25);
    --opacity-white-dark:rgba(215,215,215,.5);
    --opacity-black:rgba(0,0,0,.25);
    --opacity-black-dark:rgba(0,0,0,.5);
  }

  .dark {
    --bg-body:#161D27;
    --bg-header:#1D2734;
    --bg-boxed:#1D2734;
    --color-text: #ddd;
    --color-text-light:#9a9c9f;
    --color-text-dark:#fafafa;
    --color-primary:#7397C3;
    --color-primary-dark:#5480B6;
  }

  .sepia {
    --bg-body:#f5efe0;
    --bg-boxed:#FCF5D0;
    --color-text: #5b4636;
  }

  body {
    color: var(--color-text);
    background-color: var(--bg-body);
    transition: margin-left .5s;
    <?php if (get_option('set_background_image')) { ?>
      background-image: url(<?php echo get_option('set_background_image'); ?>);
    <?php } ?>
  }


<?php 
# Single Post (single.php)
if ( is_singular('post') ) { ?>
  /* Chapter Menu */
  .sideRight > .cover {
    text-align: center;
    max-width: 250px;
  }
  .sideRight > .cover > .gambar {
    max-width: 175px;
  }
  .sideRight > .cover > .meta-desc {
    font-size: 15px;
    font-weight: 500;
    line-height: 1.25rem;
  }
  .sideRight > .cover > .meta-desc > .entry-title > a {
    color: var(--color-text-dark);
  }
  .sideRight > .cover > .meta-desc > .daftar-isi {
    font-size: 13px;
    font-weight: 400;
    color: var(--color-text-light);
  }
  .sideRight > .chapterlist li.active {
    color: var(--color-primary);
    border-left: 4px solid var(--color-primary) !important;
    -webkit-box-shadow: inset 0 0 9px rgba(0,0,0,.05);
    box-shadow: inset 0 0 9px rgba(0,0,0,.05);
  }
  .sideRight > .chapterlist li {
    border-top: 1px solid var(--bg-body);
    font-weight: 500;
    font-family: var(--font-family-ubuntu);
    font-size: 15px;
  }
  .sideRight > .chapterlist li:hover {
    background: var(--bg-body);
    border-left: 4px solid var(--color-text);
    transition: all .1s linear;
  }
  .sideRight > .chapterlist li a {
    border-left: 4px solid transparent;
    color: var(--color-text);
    text-decoration: none;
  }
  .sideRight > .chapterlist li, .chapterlist li a {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
  }

  /* Toolbar Reader */
  .toolbar-container {
    position: static;
    top: 0;
    z-index: 1;
    transition: top .5s;
  }
  .toolbar-reader {
    opacity: .25;
    border-radius: 5px;
    border: 1px solid transparent;
  }
  .toolbar-reader:hover, .toolbar-container.show .toolbar-reader {
    opacity: 1;
    box-shadow: var(--box-shadow);
    transition: all .3s;
    background: var(--bg-body);
    border-color: var(--bg-boxed);
  }
  .toolbar-reader button {
    border-radius: 3px;
  }

  /* Change Style post */
  .toolbar-container.show {
    top: 0 !important;
  }
  .close-toggle.show {
    position: fixed;
    background: #777;
    opacity: .1;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
    cursor: auto;
  }
  .options-style {
    width: 100%;
    margin: 0 auto;
    background: var(--bg-boxed);
    max-width: 300px;
    border-radius: 5px;
    box-shadow: var(--box-shadow-light);
    font-size: 13px;
    z-index: 1;
    visibility: hidden;
    right: 0;
    top: -1000px;
    transition: all .3s ease-in-out;
  }
  .options-style.show {
    top: 0;
  }
  .options-style .btn {
    height: 45px;
    border-radius: 3px;
  }
  .options-style .btn:hover {
    background: var(--opacity-white);
  }
  .options-style .btn.btn-size {
    font-size: 19px;
    background: var(--opacity-white);
  }
  .options-style .modus-background {
    border-top: 1px solid var(--opacity-white-dark);
  }
  .options-style .modus-background > .btn > .bg-option {
    background: var(--bg-boxed);
    color: var(--color-text);
  }
  .light .modus-background > .light, .sepia .modus-background > .sepia, .dark .modus-background > .dark {
  background: var(--opacity-white-dark);
}
  .options-style #reset {color: var(--color-white);font-size: 14px;font-family: var(--font-family-ubuntu);}
  @media (max-width: 782px) {
    .options-style { max-width: 98%;left: 1%;right: 1%;margin-top: 1%;}
  }

  /* no Boxed  */
  .no-boxed .artikel, .no-boxed #boxez{
    background:none;
    box-shadow:none;
    border:none;
  } 
  #boxez {
    border: 2px solid var(--color-primary);
    background: var(--opacity-white);
  }

  /* SinglePost Novel */
  .progress-container {
    position: sticky;
    top: 0;
    width: 100%;
    height: 3px;
    background: #ccc;
    z-index: 9;
  }
  .progress-bar {
    height: 100%;
    background: var(--color-primary);
    width: 0%;
  }
  article.read-novel .entry-category {
    text-transform: uppercase;
  }
  article.read-novel .entry-content {
    line-height: 2em;
    font-size: 17px;
    font-family: var(--font-family-mali);
  }
  article.read-novel .entry-content p {
    margin-bottom: 1.75rem;
  }

  /* Bagian Share & Komentar */
  .footer-entry {
    font-family: var(--font-family-ubuntu);
    background: var(--bg-boxed);
    max-width: 550px;
  }
  .kolom-bawah .btn {
    margin:  0 .5rem !important;
  }
  .tombol-show-comment {
    background: var(--bg-body);
    color: var(--color-text-light);
    border-radius: 3px;
    font-size: 15px;
    cursor: pointer;
    width: 100%;
    text-align: center;
  }
  .tombol-show-comment:hover {
    background: var(--opacity-white);
  }
  .tombol-show-comment.active {
    cursor: not-allowed;
    opacity: .5;
  }
  .tombol-show-comment.active:hover {
    background: var(--bg-body);
  }
<?php } ?>

<?php 
# Single Novel [customPostType]
if (is_singular('novel')) { ?>
  #novel .cover, #novel .btn, #novel .info, #novel .batas, .box-shadow {
    box-shadow: var(--box-shadow-light);
  }
  .dark #novel .btn, .dark #novel .info, .dark #novel .batas {
    box-shadow: var(--box-shadow-light);
  }
  #novel .cover img {
    filter: grayscale(15%);
  }
  .dark #novel .cover img {
    filter: grayscale(2%);
  }
  #novel .btn.status {
    padding: 10px;
    color: var(--color-white);
    text-align: center;
    font-weight: 500;
    font-family: var(--font-family-ubuntu);
    font-size: 14px;
    text-transform: uppercase;
    margin-bottom: 2rem !important;
  }
  #novel .info {
    text-transform: capitalize;
  }
  #novel .info li.nani {
    margin-bottom: 15px;
    overflow: hidden;
    font-size: 14px;
    line-height: 1.5rem;
  }
  #novel .info li.nani:last-child {
    margin-bottom: 0;
  }
  #novel .info li.nani b {
    display: block;
    font-size: 15px;
  }

  #novel .sinopsis p {
    line-height: 1.8rem;
    margin-bottom: 1.25rem;
  }
  #novel .l-chapter {
    border-top: 1px dashed var(--opacity-black);
    border-bottom: 1px dashed var(--opacity-black);
    font-size: 17px;
    font-family: var(--font-family-ubuntu);
  }
  .dark #novel .l-chapter {
    border-color: var(--opacity-white);
  }
  #novel .l-chapter .item-title {
    font-weight: 700;
    min-width: 125px !important;
    margin-right: 25px;
  }
  #novel .l-chapter .item-time {
    font-size: 13px;
    color: var(--color-text-light);
    font-weight: 400;
  }

  #novel .tab, #novel #ChapterList > a { border-bottom: 1px solid #eaeaea; }
  .dark #novel .tab, .dark #novel #ChapterList > a { border-bottom: 1px solid var(--opacity-black); }
  #novel #ChapterList {
    max-height: 365px;
    overflow-x: auto;
  }
  #novel #ChapterList a {
    display: block;
    padding: 10px 7px;
    text-decoration: none;
    color: var(--color-text);
    transition: all .1s;
  }
  #novel #ChapterList > a > .chaplist {
    font-size: 16.5px;
    padding: 3px 10px;
    border-left: 3px solid transparent;
    transition: all .1s;
  }
  #novel #ChapterList a:hover {
    background: var(--opacity-white);
  }
  #novel #ChapterList > a:hover > .chaplist {
    border-left: 3px solid var(--color-primary);
    font-weight: 600;
    color: var(--color-text-dark);
  }


  /* Responsive */
  @media (max-width: 782px) {
    #novel .info > li.nani > b { float:left; }
    #novel .info > li.nani > b:after { content:" : "; }
    #novel .info > li.nani > span { float:right; }
    #novel .tab > button { margin-right: 10px; }
  }
  @media (max-width: 576px) {
    #novel .sinopsis p {line-height:1.6rem;}
    #novel .tab { white-space:nowrap;overflow:auto; }
    #novel .tab > button { margin-right: 0; }
  }
<?php } ?>

<?php # Single Blog [customPostType]
if (is_singular('blog')) { ?>
  body {
    --max-width: 800px;
  }
  .content > h2, .entry-content > h3, .entry-content > h4  {
    margin-bottom: 0;
  }
  .content p {
    line-height: 1.9rem;
    padding-top: 8px;
    margin-bottom: 24px; 
  }
  .footer-entry {
    font-family: var(--font-family-ubuntu);
  }
  .footer-entry > .tombol-show-comment {
    background: var(--bg-body);
    color: var(--color-text-light);
    border-radius: 3px;
    font-size: 15px;
    width: 100%;
  }
  @media (max-width: 768px) {
    .content p {font-size: 15px; line-height: 1.65rem;}
  }
<?php } ?>
</style>