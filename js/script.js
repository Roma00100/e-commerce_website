window.addEventListener('scroll', function () {
  var scrollPosition = window.scrollY;
  var backToTopButton = document.getElementById('containerTop');

  if (scrollPosition > 700) {
    backToTopButton.style.display = 'block';
  } else {
    backToTopButton.style.display = 'none';
  }
});


// ------------------SHOPING BASKET START---------------------

// const myBasketBtn = document.querySelector('.myBasketBtnJS');
// const myBasket = document.querySelector('.myBasket');

// let myBasketVisible = false;

// // myBasketBtn.addEventListener('mouseover', ()=> {
// myBasketBtn.addEventListener('click', ()=> {
//   if(myBasketVisible == false) { 

//     myBasket.style.translate = '0 0'
//     myBasketVisible = true;
//   }else{

//     myBasket.style.translate = '300px 0px'
//     myBasketVisible = false;
//   }
//   ;
// });

// myBasketBtn.addEventListener('mouseout', ()=> {
//   if(myBasketVisible == true) { 

//     myBasket.style.translate = '300px 0px'
//     myBasketVisible = false;

//   }
//   ;
// });


const myBasketBtn = document.querySelectorAll('.myBasketBtnJS');
const myBasket = document.querySelector('.myBasket');

let myBasketVisible = false;

myBasketBtn.forEach(btn => {
  
btn.addEventListener('click', ()=> {
  if(myBasketVisible == false) { 
    myBasket.style.transform = 'translate(0, 0)';
    myBasket.style.transition = 'transform 0.5s ease-out';

    myBasketVisible = true;
  }else{
    myBasket.style.transform = 'translate(305px, 0)';
    myBasket.style.transition = 'transform 0.5s ease-out';
    myBasketVisible = false;
  }
  ;
});
});



// ------------------SHOPING BASKET END-----------------------



// ---------------------SEARCH BTN START-----------------------


const mySearchIcon = document.querySelectorAll('.mySearchIconJS');
const mySearchField = document.querySelector('.mySearchField');

let mySearchFieldVisible = false;

mySearchIcon.forEach(btn => {
  
btn.addEventListener('click', ()=> {
  if(mySearchFieldVisible == false) { 
    mySearchField.style.width = '250px';
    mySearchField.style.visibility = 'visible';
    mySearchField.style.margin = '0 0 0 1rem';
    mySearchField.style.transition = '0.5s ease-out';

    mySearchFieldVisible = true;
  }else{
    mySearchField.style.width = '0px';
    mySearchField.style.visibility = 'hidden';
    mySearchField.style.margin = '0 0 0 0';
    mySearchField.style.transition = '0.5s ease-out';
    mySearchFieldVisible = false;
  }
  ;
});
});

// ----------------------SEARCH BTN END-----------------------


 
function search () {

  let xhttp = new XMLHttpRequest(); 
  let value = document.getElementById("search").value
       
  xhttp.open("GET","./product_search.php?search="+value);

   
  };

// ----------------------SHOW / HIDE PASSWORD START -----------------------

  function showPassword(){
    let passwordStatus = document.getElementById("password").getAttribute("type");

    if(passwordStatus == "password"){
        document.getElementById("password").setAttribute("type", "text");
        document.getElementById("basic-addon3").innerHTML = "Hide password";
    }else {
        document.getElementById("password").setAttribute("type", "password");
        document.getElementById("basic-addon3").innerHTML = "Show password";
    }
}

document.getElementById("basic-addon3").addEventListener("click", showPassword);

// ----------------------SHOW / HIDE PASSWORD END -----------------------
