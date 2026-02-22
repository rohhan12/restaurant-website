const mobileToggle = document.getElementById('mobileToggle');
const navMenu = document.getElementById('navMenu');

if (mobileToggle) {
    mobileToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active');
    });
}

let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

if (slides.length > 0) {
    const dotsContainer = document.querySelector('.slider-dots');
    
    slides.forEach((slide, i) => {
        const dot = document.createElement('span');
        dot.className = 'dot';
        if (i === 0){
            dot.classList.add('active');
        }
        dot.onclick = () => showSlide(i);
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.dot');

    function showSlide(n) {
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        
        if (n >= slides.length) {
            currentSlide = 0;
        } else if (n < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = n;
        }
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }
    document.querySelector('.slider-btn.next').onclick = () => showSlide(currentSlide + 1);
    document.querySelector('.slider-btn.prev').onclick = () => showSlide(currentSlide - 1);

    setInterval(() => showSlide(currentSlide + 1), 5000);
}

const reservationForm = document.getElementById('reservationForm');
if (reservationForm) {
    reservationForm.addEventListener('submit', function(e) {
        const name = document.querySelector('input[name="name"]').value;
        const phone = document.querySelector('input[name="phone"]').value;
        const date = document.querySelector('input[name="date"]').value;
        const time = document.querySelector('select[name="time"]').value;
        const guests = document.querySelector('input[name="guests"]').value;
        
        if (!name || !phone || !date || !time || !guests) {
            e.preventDefault();
            alert('Please fill all fields!!!');
        }
    });
}