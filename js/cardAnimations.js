
window.addEventListener('load', LoadCards());

function LoadCards(){
    currentCard=0;
    flipCounter=0;
    nextButton = document.getElementById("next-button").addEventListener("click", nextCard); 
    prevButton = document.getElementById("prev-button").addEventListener("click", prevCard); 
    flipButton = document.getElementById("flip-button").addEventListener("click",flipCard);
    background = document.getElementById("cardContainer");
    cardContent = document.getElementsByClassName("card-content"); 
    cardContent[currentCard].classList.add("active");
    flipContent = document.querySelectorAll(".active > div");
}

function nextCard(){
    fadeOut();
    if(currentCard < cardContent.length -1){
        currentCard ++;
        cardContent[currentCard - 1].classList.add("dis-none");
        cardContent[currentCard - 1].querySelectorAll("div")[0].classList.remove("flip-content");
        cardContent[currentCard - 1].querySelectorAll("div")[1].classList.remove("flip-content");

        cardContent[currentCard].querySelectorAll("div")[0].classList.add("flip-content");
        cardContent[currentCard].querySelectorAll("div")[1].classList.add("flip-content");
        flipContent = cardContent[currentCard].getElementsByClassName("flip-content");
        flipContent[1].classList.add("dis-none");
        flipContent[0].classList.remove("dis-none");
        cardContent[currentCard].classList.remove("dis-none");
    }
    else{
        cardContent[currentCard].classList.add("dis-none");
        cardContent[currentCard].querySelectorAll("div")[0].classList.remove("flip-content");
        cardContent[currentCard].querySelectorAll("div")[1].classList.remove("flip-content");

        currentCard = 0;

        cardContent[currentCard].querySelectorAll("div")[0].classList.add("flip-content");
        cardContent[currentCard].querySelectorAll("div")[1].classList.add("flip-content");
        flipContent = cardContent[currentCard].getElementsByClassName("flip-content");
        flipContent[1].classList.add("dis-none");
        flipContent[0].classList.remove("dis-none");
        cardContent[currentCard].classList.remove("dis-none");
    }
    fadeIn();
}

function prevCard(){
    fadeOut();
    if(currentCard > 0 && currentCard <= cardContent.length -1){
        currentCard--;
        cardContent[currentCard + 1].classList.add("dis-none");
        cardContent[currentCard].querySelectorAll("div")[0].classList.add("flip-content");
        cardContent[currentCard].querySelectorAll("div")[1].classList.add("flip-content");
        flipContent = cardContent[currentCard].getElementsByClassName("flip-content");
        flipContent[1].classList.add("dis-none");
        flipContent[0].classList.remove("dis-none");
        cardContent[currentCard].classList.remove("dis-none");
    }
    else{
        cardContent[currentCard].classList.add("dis-none");
        cardContent[currentCard].querySelectorAll("div")[0].classList.add("flip-content");
        cardContent[currentCard].querySelectorAll("div")[1].classList.add("flip-content");
        
        currentCard = cardContent.length - 1;

        cardContent[currentCard].querySelectorAll("div")[0].classList.add("flip-content");
        cardContent[currentCard].querySelectorAll("div")[1].classList.add("flip-content");
        flipContent = cardContent[currentCard].getElementsByClassName("flip-content");
        flipContent[1].classList.add("dis-none");
        flipContent[0].classList.remove("dis-none");
        cardContent[currentCard].classList.remove("dis-none");
    }
    fadeIn();
}




function fadeOut(){
    if(cardContent[currentCard].classList.contains("fadeOut")===true){
        cardContent[currentCard].classList.remove("fadeOut");
    }
    if(cardContent[currentCard].classList.contains("fadeIn")===true){
        cardContent[currentCard].classList.remove("fadeIn");
    }
    cardContent[currentCard].classList.add("fadeOut");
}

function fadeIn(){
    if(cardContent[currentCard].classList.contains("fadeOut")===true){
        cardContent[currentCard].classList.remove("fadeOut");
    }
    if(cardContent[currentCard].classList.contains("fadeIn")===true){
        cardContent[currentCard].classList.remove("fadeIn");
    }
    cardContent[currentCard].classList.add("fadeIn");
}

function flipCard(){
    if(flipCounter < flipContent.length - 1){
        flipCounter ++;
        flipContent[flipCounter - 1].classList.add("dis-none");
        flipContent[flipCounter].classList.remove("dis-none");
    }
    else{
        flipContent[flipCounter].classList.add("dis-none");
        flipCounter = 0;
        flipContent[flipCounter].classList.remove("dis-none");
    }
}