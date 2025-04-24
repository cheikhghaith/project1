let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
};
window.onscroll = () =>{
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');
};


var swiper =new Swiper(".home-slider", {
  loop:true,
  grabCursor:true,
  effect:"slide",
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".reviews-slider", {
    loop: true,
    spaceBetween: 20,
    autoHeight: true,
    grabCursor: true,
    breakpoints: {
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
});
let loadMoreBtn = document.querySelector('.packages .load-more .btn');
let currentItem = 6;
let boxes = Array.from(document.querySelectorAll('.packages .box-container .box'));

// Show the initial 6 (your CSS already shows 1 to 6)
boxes.slice(0, currentItem).forEach(box => box.style.display = 'inline-block');

loadMoreBtn.onclick = () => {
  for (let i = currentItem; i < currentItem + 3; i++) {
    if (boxes[i]) {
      boxes[i].style.display = 'inline-block';
    }
  }

  currentItem += 3;

  if (currentItem >= boxes.length) {
    loadMoreBtn.style.display = 'none';
  }
};
document.querySelector('.book-form').addEventListener('submit', function(e) {
        var name = document.querySelector('input[name="name"]').value;
        var email = document.querySelector('input[name="email"]').value;
        var phone = document.querySelector('input[name="phone"]').value;

        if (name == "" || email == "" || phone == "") {
            e.preventDefault();  // Stop form submission
            alert("Please fill in all the required fields!");
        }
    });
