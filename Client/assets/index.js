//Javascript for th dropdown
const allDropdown = document.querySelector('.side-dropdown');
const iconRight = document.querySelector('.icon-right');
const iconRights = document.querySelector('.icon-rights');

//JavaScript for the active
const activePage = window.location.pathname;
const navlinks = document.querySelectorAll('div .act').forEach(link =>{
    // console.log(link.href)
    if(link.href.includes(`${activePage}`)){
        // console.log(`${activePage}`);
        link.classList.add('active');
    }
})


//SIDEBR COLLPASE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');


toggleSidebar.addEventListener('click', function () {
  sidebar.classList.toggle('hide');

  if(sidebar.classList.contains('hide')){
    allSideDivider.forEach(item=> {
      item.textContent = item.dataset.text;
    })
  }
  
})


sidebar.addEventListener('mouseleave' , function () {
  if(this.classList.contains('hide')) {
    allDropdown.forEach(item=> {
      const a = item.parentElement.querySelector('a:first-child');
          a.classList.remove('active');
          item.classList.remove('show');
      })
      allSideDivider.forEach(item=> {
        item.textContent = '-'
      })
  }

}) 

sidebar.addEventListener('mouseenter' , function () {
  if(this.classList.contains('hide')) {
    allDropdown.forEach(item=> {
      const a = item.parentElement.querySelector('a:first-child');
          a.classList.remove('active');
          item.classList.remove('show');
      })
      allSideDivider.forEach(item=> {
        item.textContent = item.dataset.text;
      })
  }

}) 
 

//PROGRESSBAR
const allProgress = document.querySelectorAll('main .cards .progress');

allProgress.forEach(item=> {
    item.style.setProperty('--value', item.dataset.value)
})

const themeToggler = document.querySelector(".theme-toggler");

//change theme
themeToggler.addEventListener('click', () => {
  themeToggler.classList.toggle("theme-toggler-on");
  document.body.classList.toggle('dark-theme-variables');

  themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
  themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

  if(localStorage.getItem("theme") == "light"){
    localStorage.setItem("theme", "dark");
}
else{
    localStorage.setItem("theme", "light");
}
})


if(localStorage.getItem("theme") == "light"){
  themeToggler.classList.remove("theme-toggler-on");
  document.body.classList.remove("dark-theme-variables");  
}
else if(localStorage.getItem("theme") == "dark"){
  themeToggler.classList.add("theme-toggler-on");
  document.body.classList.add("dark-theme-variables");  
}
else{
  localStorage.setItem("theme", "light");
}      

//Javascript for the right sidebar
const body = document.querySelector("body"),
      rightbar = body.querySelector(".rightbar"),
      toggle = body.querySelector(".toggle");

      toggle.addEventListener('click', () =>{
        rightbar.classList.toggle('close');
      });


