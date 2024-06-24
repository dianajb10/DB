function show_edit(){
   $('#show_edit_modal').modal('toggle')
}
function new_modal1(dataset,type){
    $('#'+type).modal('toggle')
    $('#show_edit_modal').modal('hide')
    var dataID = dataset.getAttribute('data-id');
    var dataTitle = dataset.getAttribute('data-title');
    var dataDescription = dataset.getAttribute('data-description');
    var dataImage = dataset.getAttribute('data-image');


    document.getElementById('project_id').value = dataID
    document.getElementById('editProjectTitle').value = dataTitle
    document.getElementById('editProjectDescription').value = dataDescription
    document.getElementById('editProjectImage').src = dataImage

    document.getElementById('movie_id').value = dataID
    document.getElementById('editMovieTitle').value = dataTitle
    document.getElementById('editMovieDescription').value = dataDescription
    document.getElementById('editMovieImage').src = dataImage

    document.getElementById('game_id').value = dataID
    document.getElementById('editGameTitle').value = dataTitle
    document.getElementById('editGameDescription').value = dataDescription
    document.getElementById('editGameImage').src = dataImage
    console.log(dataID);
}
function new_modal(type){
        $('#'+type).modal('toggle')
        $('#show_edit_modal').modal('hide')
}
document.addEventListener('DOMContentLoaded', function() {
    // Select all navbar links
    const navLinks = document.querySelectorAll('.navbar-nav a, .navbar-brand');

    // Add click event listener to each link
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Prevent default anchor behavior
            e.preventDefault();

            // Get the target element's id from the href attribute
            const targetId = this.getAttribute('href').substring(1);

            // Scroll to the target element
            document.getElementById(targetId).scrollIntoView({
                behavior: 'smooth'
            });

            // Remove 'active' class from all nav-links
            navLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });

            // Add 'active' class to the clicked nav-link
            this.classList.add('active');
        });
    });

    // Highlight active section in navbar on scroll
    document.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        let shrinkNavbar = false; // Flag to determine if navbar should shrink

        // Iterate through each section to check its position relative to scroll
        document.querySelectorAll('section').forEach(section => {
            const sectionId = section.getAttribute('id');
            const navLink = document.querySelector(`.navbar-nav a[href="#${sectionId}"]`);

            // Check if section is in viewport
            if (section.offsetTop <= scrollPosition && section.offsetTop + section.offsetHeight > scrollPosition) {
                // Add 'active' class to corresponding navbar link
                navLink.classList.add('active');
                
                // Set flag to shrink navbar if scroll position is greater than 0
                shrinkNavbar = scrollPosition > 0;
            } else {
                // Remove 'active' class from corresponding navbar link
                navLink.classList.remove('active');
            }
        });

        // Add or remove 'shrink' class based on flag value
        const navbar = document.querySelector('.navbar');
        if (shrinkNavbar) {
            navbar.classList.add('shrink');
        } else {
            navbar.classList.remove('shrink');
        }
    });
});

$(".card").hover(function(){
    $(".card").removeClass("active");
    $(this).addClass("active");
    
});

document.addEventListener('DOMContentLoaded', () => {
    const interBubble = document.querySelector('.interactive');
    let curX = 0;
    let curY = 0;
    let tgX = 0;
    let tgY = 0;

    const move = () => {
        curX += (tgX - curX) / 20;
        curY += (tgY - curY) / 20;
        interBubble.style.transform = `translate(${Math.round(curX)}px, ${Math.round(curY)}px)`;
        requestAnimationFrame(move);
    };

    window.addEventListener('mousemove', (event) => {
        tgX = event.clientX;
        tgY = event.clientY;
    });

    move();
});