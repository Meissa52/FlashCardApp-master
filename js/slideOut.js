//Slide out functions for hidden nav in live views

window.addEventListener('load', LoadNav());

function LoadNav(){
    slideOutAction = document.getElementById("slide-out-action");
    slideButtons = document.getElementsByClassName("slide-button");
    slideOut = document.getElementById("navigation-btn");
    mainContent = document.getElementById("main-content");
    closeButton = document.getElementById("close-btn");

    slideOut.addEventListener("click", changeView);
    closeButton.addEventListener("click", changeView);
    slideOut.addEventListener("mouseover", changeStyle);
    slideOut.addEventListener("mouseout", startingStyle);

    minView();
}


window.onscroll = function(){
    scrollAmount = window.pageYOffset;
    scrollAmount = scrollAmount + 85;
    slideOut.style.top = `${scrollAmount}` + "px";
    slideOut.style.transition = "ease-in";
    slideOut.style.transitionDuration = ".3s";
}



function changeView(){
    if(slideOutAction.classList.contains("full-view")){
        minView();
        startingStyle();
    }
    else if(slideOutAction.classList.contains("min-view")){
        fullView();
        changeStyle();
    }
}

function fullView(){
    console.log("Full view ran");
    slideOutAction.classList.remove("dis-none");
    slideOutAction.classList.remove("min-view");
    slideOutAction.classList.add("full-view");
    mainContent.style.display="none";
    slideOutAction.style.display = "block";
}

function minView(){
    console.log("ran minView");
    if(!slideOutAction.classList.contains("dis-none")){
        slideOutAction.classList.add("dis-none");
    }
    slideOutAction.classList.add("min-view");
    slideOutAction.classList.remove("full-view");
    slideOutAction.style.display = "none";
    mainContent.style.display="block";
}

function changeStyle(){
    console.log("Change Style Ran");
    slideOut.style.backgroundColor = "rgb(255,255,255)";
    slideOut.style.transition = "ease-in-out";
    slideOut.style.transitionDuration = ".1s";
}
function startingStyle(){
    slideOut.style.backgroundColor = "rgba(245,245,245,0)";
    slideOut.style.transition = "ease-in-out";
    slideOut.style.transitionDuration = ".1s";
}
