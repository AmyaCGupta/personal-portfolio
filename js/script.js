// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Contact form validation
const contactForm = document.querySelector('form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        let errors = [];

        if (name.length < 2) {
            errors.push("Name must be at least 2 characters.");
        }

        // Simple email regex
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errors.push("Enter a valid email address.");
        }

        if (message.length < 5) {
            errors.push("Message must be at least 5 characters.");
        }

        if (errors.length > 0) {
            e.preventDefault(); // stop form submission
            alert(errors.join("\n"));
        }
    });
});

// Example: highlight nav link on scroll
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section');
    let scrollPos = window.scrollY || window.pageYOffset;
    
    sections.forEach(section => {
        const top = section.offsetTop - 50;
        const bottom = top + section.offsetHeight;
        const id = section.getAttribute('id');

        const navLink = document.querySelector(`nav a[href="#${id}"]`);
        if (scrollPos >= top && scrollPos < bottom && navLink) {
            document.querySelectorAll('nav a').forEach(link => link.classList.remove('active'));
            navLink.classList.add('active');
        }
    });
});