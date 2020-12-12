// Make a simple selector
function $(el) {
  return document.querySelector(el)
}

//* Sidenav
sideNav('#mySidenav', '#openNav', '#closeNav');
function sideNav(el, open, close) {
  $(open).addEventListener("click", function () {
    $(el).style.width = "85%";
    $("body").style.overflowY = "hidden";
    $("#bgsidemenu").style.display = "block";
  }),
  $(close).addEventListener("click", function () {
    $(el).style.width = "0";
    $("body").style.overflowY = "inherit";
    $("#bgsidemenu").style.display = "none";
  });
}

// accordion menu 
let acc = document.getElementsByClassName("menu-item-has-children");
for (let i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    const panel = this.children;
    if (panel[1].style.maxHeight) {
      panel[1].style.maxHeight = null;
    } else {
      panel[1].style.maxHeight = panel[1].scrollHeight + "px";
    }
  });
}

// TabContent
function openTab(evt, id) {
  let i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  $('#'+id).style.display = "block";
  evt.currentTarget.className += " active";
}

// Show Class
function toggle(el, toggleClass) {
  return $(el).classList.toggle(toggleClass);
} 
// percobaan
function toggleStyle() {
  const x = $(".options-style");
  if (x.className === "options-style p-2 position-absolute") {
    $(".toolbar-container").classList.add("show");
    $(".close-toggle").classList.add("show");
    x.classList.add("show");
  } else { 
    $(".close-toggle").classList.remove("show");
    $(".toolbar-container").classList.remove("show");
    x.classList.remove("show"); 
  }
}

// Dark/Light Mode
toggleCache(".darkmode", "dark", "theme");
function toggleCache(elementClick, toggleClass, cacheName) {
  const currentTheme = localStorage.getItem(cacheName);
  if (currentTheme == toggleClass) {
    $("body").classList.toggle(toggleClass);
  }
  
  $(elementClick).addEventListener("click", function () {
    $("body").classList.toggle(toggleClass);
    const theme = $("body").classList.contains(toggleClass) ? toggleClass : "";
  
    localStorage.setItem(cacheName, theme);
    // to set cache single post ==> Background Modus
    localStorage.setItem('bg-modus', theme);
  });
}


/**
  * Kondisi = Singgle Post [.read-novel]
  */
  if ($("article.read-novel")) {

  // chapter list for single chapter
  sideNav('.sideRight', '.list-chapter', '#bgsidemenu');
  
  /**
   * display post (read novel style)
   *
   * how to use 
   * el = element html to use *string => ex "article p"
   * mmSize = set minimal or maximal number *float/int => ex '12'
   * delta = use upsize or dowsize *float/int => ex '1' or '-1'  
   * gProper = property css *string => ex "font-size" or "line-height" etc
   * 
   * Example : 
   *  1. changeSize(18, 1, "font-size");
   *     result upsize with min Font 12px and maximal font 18px
   *  2. changeSize(12, -1, "font-size");
   *     result downsize with min Font 12px and maximal font 18px
   * 
   */

  function changeSize(el, mmSize, delta, gProper) {
    let elems = document.querySelectorAll(el);

    for (let i = 0; i < elems.length; i++) {
      let style = window.getComputedStyle(elems[i], null).getPropertyValue(gProper);
      let getSize = parseFloat(style); 
      if (getSize != mmSize) {
        getSize += delta;
      }
      switch (gProper) {
        case 'max-width':
          $("body").style.cssText = "--max-width:" + getSize + "px",
          localStorage.setItem("max-width", getSize + "px");
          break;
        case 'font-size':
          elems[i].style.fontSize = getSize + "px",
          localStorage.setItem("font-size", getSize + "px");
          break;
        case 'line-height':
          elems[i].style.lineHeight = getSize + "px",
          localStorage.setItem("line-height", getSize + "px");
          break;
        case 'margin-bottom':
          elems[i].style.marginBottom = getSize + "px",
          localStorage.setItem("margin-bottom", getSize + "px");
          break;
      }
    }
  }


  window.onscroll = function() {
    progressBar();
    hideScroll();
  }

  // Progress Scroll
  function progressBar() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    $(".progress-bar").style.width = scrolled + "%";
  }

  // Hide Scroll Bottom
  let prevScrollpos = window.pageYOffset;
  function hideScroll() {
  const currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      $(".toolbar-container").style.cssText = "position:static";
      if (window.pageYOffset > $(".entry-content").offsetTop) {
        $(".toolbar-container").style.cssText = "position:sticky;";
        $(".toolbar-reader").classList.add("ml-4");
        $(".toolbar-reader").classList.add("mr-4");
        $(".toolbar-reader").style.cssText = "opacity: 1;box-shadow: var(--box-shadow);background: var(--bg-body);border-color: var(--bg-boxed);";
      } else {
        $(".toolbar-reader").classList.remove("ml-4");
        $(".toolbar-reader").classList.remove("mr-4");
        $(".toolbar-reader").removeAttribute("style");   
      }
    } else {
      $(".toolbar-container").style.top = "-75px";
    }
    prevScrollpos = currentScrollPos;
  }


  // Reset
  $("#reset").onclick = function () {
    // Remove all cache
    localStorage.clear();
    // mengecualikan darkmode reset
    if ($("body").classList.contains("dark")) {
      localStorage.setItem("theme", "dark");
    }
    // mengecualikan light mode reset
    if ($("body").classList.contains("light")) {
      localStorage.setItem("bg-modus", "light");
    }
    // mengecualikan sepia mode reset
    if ($("body").classList.contains("sepia")) {
      localStorage.setItem("bg-modus", "sepia");
    }

    // Default select font Mali
    $("#input-font").selectedIndex = "3"; 

    $("body").classList.remove("no-boxed");
    $("body").removeAttribute("style");
    $("article.read-novel .entry-content").removeAttribute("style");

    let el = document.querySelectorAll("article.read-novel .entry-content p");
    for (let i = 0; i < el.length; i++) {
      el[i].removeAttribute("style");
    }
  }

  // option style + chache
  let mWidth = localStorage.getItem("max-width");
  if (mWidth == null) {} else {
    $("body").style.cssText = "--max-width:" + mWidth;
  }
  let oFont = localStorage.getItem("font-size");
  if (oFont == null) {} else {
    $("article.read-novel .entry-content").style.fontSize = oFont;
  }
  let familyFont = localStorage.getItem("font-family");
  if (familyFont == null) {
    // Default select font Mali
    $("#input-font").selectedIndex = "3"; 
  } else {
    $("#input-font").value = familyFont;
    $("article.read-novel .entry-content").style.fontFamily = familyFont;
  }
  let oLineHeight = localStorage.getItem("line-height");
  if (oLineHeight == null) {} else {
    $("article.read-novel .entry-content").style.lineHeight = oLineHeight;
  }
  let oMarginBottom = localStorage.getItem("margin-bottom");
  if (oMarginBottom == null) {} else {
    let elems = document.querySelectorAll("article.read-novel .entry-content p");
    for (let i = 0; i < elems.length; i++) {
      elems[i].style.marginBottom = oMarginBottom;
    }
  }
  optionsWidth(".container"),
  optionsFont("article.read-novel .entry-content"), 
  optionsLineHeight("article.read-novel .entry-content"),
  optionsMarginBottom("article.read-novel .entry-content p"); 
  // change font family
  function changeFont(font){
    $("article.read-novel .entry-content").style.fontFamily = font.value;
    localStorage.setItem("font-family", font.value);
  }
  toggleCache("#boxez", "no-boxed", "boxed");

  function optionsWidth(el) {
    $('#up-width').onclick = function () {
      changeSize(el, 1380, 50, "max-width");
    };
    $('#down-width').onclick = function () {
      changeSize(el, 680, -50, "max-width");
    };
  }
  function optionsFont(el) {
    $('#up-font-size').onclick = function () {
      changeSize(el, 21, 1, "font-size");
    };
    $('#down-font-size').onclick = function () {
      changeSize(el, 13, -1, "font-size");
    };
  }
  function optionsMarginBottom(el) {
    $('#up-mb').onclick = function () {
      changeSize(el, 48, 4, "margin-bottom");
    };
    $('#down-mb').onclick = function () {
      changeSize(el, 16, -4, "margin-bottom");
    };
  }
  function optionsLineHeight(el) {
    $('#up-lh').onclick = function () {
      changeSize(el, 38, 2, "line-height");
    };
    $('#down-lh').onclick = function () {
      changeSize(el, 18, -2, "line-height");
    };
  }
  //# Created by Logor ==> fb.com/mr.robotkj

}