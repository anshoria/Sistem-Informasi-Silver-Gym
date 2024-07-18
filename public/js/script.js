// kelas active
document.addEventListener("DOMContentLoaded", function () {
   
    var navLinks = document.querySelectorAll('.nav-link');

    
    var excludedPaths = ['/Login', '/Register'];

  
    function handleNavClick(event) {
       
        var href = event.target.getAttribute('href');

     
        if (!excludedPaths.includes(href)) {
            
            navLinks.forEach(function (navLink) {
                navLink.classList.remove('active');
            });

    
            event.target.classList.add('active');
        }
    }


    navLinks.forEach(function (navLink) {
        navLink.addEventListener('click', handleNavClick);
    });
});


// preview gambar dashboard
function previewImage() {
    var input = document.getElementById('foto');
    var preview = document.getElementById('preview');

    var reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}


// tombol scrolldown
document.addEventListener("DOMContentLoaded", function() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");

    window.addEventListener("scroll", function() {
        // Tampilkan tombol ketika pengguna menggulir lebih dari 300 piksel
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    });

    scrollToTopBtn.addEventListener("click", function() {
        // Gulir halaman ke atas saat tombol diklik
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });
});


// dark mode

(() => {
    'use strict'
  
    const getStoredTheme = () => localStorage.getItem('theme')
    const setStoredTheme = theme => localStorage.setItem('theme', theme)
  
    const getPreferredTheme = () => {
      const storedTheme = getStoredTheme()
      if (storedTheme) {
        return storedTheme
      }
  
      return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }
  
    const setTheme = theme => {
      if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-bs-theme', 'dark')
      } else {
        document.documentElement.setAttribute('data-bs-theme', theme)
      }
    }
  
    setTheme(getPreferredTheme())
  
    const showActiveTheme = theme => {
     
      const activeThemeIcon = document.querySelector('.theme-icon-active')
      const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
      const iconOfActiveBtn = btnToActive.querySelector('span').dataset.themeIcon
  
      document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
        element.classList.remove('active')
      })
  
      btnToActive.classList.add('active')
      activeThemeIcon.classList.remove(activeThemeIcon.dataset.themeIconActive)
      activeThemeIcon.classList.add(iconOfActiveBtn)
      activeThemeIcon.dataset.iconOfActive = iconOfActiveBtn
    }
  
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
      const storedTheme = getStoredTheme()
      if (storedTheme !== 'light' && storedTheme !== 'dark') {
        setTheme(getPreferredTheme())
      }
    })
  
    window.addEventListener('DOMContentLoaded', () => {
      showActiveTheme(getPreferredTheme())
  
      document.querySelectorAll('[data-bs-theme-value]')
        .forEach(toggle => {
          toggle.addEventListener('click', () => {
            const theme = toggle.getAttribute('data-bs-theme-value')
            setStoredTheme(theme)
            setTheme(theme)
            showActiveTheme(theme, true)
          })
        })
    })
  })()



