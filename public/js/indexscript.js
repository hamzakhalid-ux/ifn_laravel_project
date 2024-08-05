$(document).ready(function() {
    $("#news-slider").owlCarousel({
        items : 2,
        itemsDesktop:[1199,2],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["",""],
        pagination:true,
        autoPlay:true
    });
});

let counter = document.querySelectorAll(".counter")
let arr = Array.from(counter)

arr.map((item)=>{
    let count = 0

    function CounterUp(){
        count++
        item.innerHTML = count
        if(count == item.dataset.number){
            clearInterval(stop);
        }
    }
    let stop = setInterval(
        function(){
            CounterUp();
        },100/item.dataset.speed
    );
})


const body = document.querySelector("body"),
      nav = document.querySelector("nav"),

      sidebarOpen = document.querySelector(".sidebarOpen"),
      siderbarClose = document.querySelector(".siderbarClose");


// js code to toggle dark and light mode



        // js code to keep user selected mode even page refresh or file reopen


// js code to toggle search box



//   js code to toggle sidebar
sidebarOpen.addEventListener("click" , () =>{
    nav.classList.add("active");
});

body.addEventListener("click" , e =>{
    let clickedElm = e.target;

    if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")){
        nav.classList.remove("active");
    }
});


