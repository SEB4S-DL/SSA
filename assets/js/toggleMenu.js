let toggleMenuTrigger = document.getElementById("toggle-menu-trigger");
let sidebar = document.querySelector(".sidebar");
let sidebarBackground = document.querySelector(".sidebar-background");

toggleMenuTrigger.addEventListener("click", () =>{
  toggleId(sidebar, "visible-sidebar");
  setTimeout(() => {
    sidebar.classList.toggle("sidebar-animation");
  }, 10);
  sidebarBackground.classList.toggle("visible-sidebar-background");
});

sidebarBackground.addEventListener("click", () =>{
  toggleId(sidebar, "visible-sidebar");
  sidebar.classList.toggle("sidebar-animation");
  sidebarBackground.classList.toggle("visible-sidebar-background");
});

function toggleId(element, id){
  if (element.getAttribute("id") == id){
    element.removeAttribute("id");
  }
  else{
    element.setAttribute("id", id);
  }
}