document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navLinks = document.querySelector('nav ul');

    hamburgerMenu.addEventListener('click', function () {
        // Toggle 'active' class immediately for the hamburger menu
        hamburgerMenu.classList.toggle('active');

        // Toggle 'show' class for the navigation links after a short delay
        setTimeout(function () {
            navLinks.classList.toggle('show');
        }, 50); // Adjust the delay according to your preference
    });

    window.addEventListener('scroll', function () {
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('nav ul li a');
        let current = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= (sectionTop - sectionHeight / 3)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });

        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.remove('transparent');
            navbar.classList.add('solid');
        } else {
            navbar.classList.remove('solid');
            navbar.classList.add('transparent');
        }
    });

    // Initialize scroll event manually to update navbar class
    window.dispatchEvent(new Event('scroll'));






    let currentIndex = 0;

    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const nextButton = document.querySelector('.next');
    const prevButton = document.querySelector('.prev');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });

        const offset = -index * 100;
        document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(currentIndex);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            showSlide(currentIndex);
        });
    });

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    // Optional: Auto-slide functionality
    // setInterval(nextSlide, 7000); // Change slide every 7 seconds

    showSlide(currentIndex);




    const plans = document.querySelectorAll('.plan');
    const selectPlanButton = document.getElementById('select-plan');
    const popup = document.getElementById('popup');
    const closePopupButton = document.querySelector('.close-popup');
    const buyNowButton = document.getElementById('buy-now');
    const productDescription = document.querySelector('.product-description');
    const productPrice = document.querySelector('.product-price');
    const oldPriceElement = document.querySelector('.total .old-price');
    const newPriceElement = document.querySelector('.total .new-price');
    let selectedPlan = null;

    plans.forEach(plan => {
        plan.addEventListener('click', function () {
            plans.forEach(p => p.classList.remove('selected'));
            this.classList.add('selected');
            selectedPlan = {
                plan: this.getAttribute('data-plan'),
                price: this.getAttribute('data-price'),
                oldPrice: this.getAttribute('data-old-price'),
                newPrice: this.getAttribute('data-new-price'),
                savings: this.getAttribute('data-savings')
            };

            // Update the total prices
            oldPriceElement.textContent = selectedPlan.oldPrice;
            newPriceElement.textContent = selectedPlan.newPrice;
        });
    });

    selectPlanButton.addEventListener('click', function () {
        if (selectedPlan) {
            productDescription.textContent = `Delivery every ${selectedPlan.plan}`;
            productPrice.textContent = selectedPlan.price;
            popup.style.display = 'flex';
        } else {
            alert('Please select a plan first.');
        }
    });

    closePopupButton.addEventListener('click', function () {
        popup.style.display = 'none';
    });

    buyNowButton.addEventListener('click', function () {
        if (selectedPlan) {
            localStorage.setItem('selectedPlan', JSON.stringify(selectedPlan));
            const Plan = selectedPlan.plan; 
            
            window.location.href = 'checkout.php?Plan=' + Plan;
        }
    });


    // About section image slider
    const aboutSlides = document.querySelectorAll('.about-slider .slide1');
    let aboutCurrentIndex = 0;

    function showAboutSlide(index) {
        aboutSlides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextAboutSlide() {
        aboutCurrentIndex = (aboutCurrentIndex + 1) % aboutSlides.length;
        showAboutSlide(aboutCurrentIndex);
    }

    setInterval(nextAboutSlide, 5000); // Change image every 5 seconds

    showAboutSlide(aboutCurrentIndex);

});
