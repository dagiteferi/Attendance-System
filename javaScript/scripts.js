$(document).ready(function(){
    $(window).scroll(function(){
      if(this.scrollY > 20){
        $(".navbar").addClass("sticky");
        $(".goTop").fadeIn();
      }
      else{
        $(".navbar").removeClass("sticky");
        $(".goTop").fadeOut();
      }
    });
  
    $(".goTop").click(function(){scroll(0,0)});
  
    $('.menu-toggler').click(function(){
      $(this).toggleClass("active");
      $(".navbar-menu").toggleClass("active");
    });
  
    $(".works").magnificPopup({
      delegate: 'a',
      type: 'image',
      gallery:{enabled:true}
    });
  });

//button manuplation 
  function showAlert() {
    alert("You need to sign-up first before Add a testemoiyas");
}
function showAlert1() {
  alert("You need to sign-up first before Show my-Blog");
}


//testimony
 
    // Array to store the testimonials
var testimonials = [];

// Function to submit a testimonial
function submitTestimonial() {
    // Get the input values
    var name = document.getElementById('name').value;
    var jobTitle = document.getElementById('jobTitle').value;
    var photo = document.getElementById('photo').files[0];
    var testimonial = document.getElementById('testimonial').value;

    // Add the new testimonial to the array
    testimonials.push({
        name: name,
        jobTitle: jobTitle,
        photo: URL.createObjectURL(photo),// creat the unique URL for the image
        testimonial: testimonial
    });

    // Clear the input fields
    document.getElementById('name').value = '';
    document.getElementById('jobTitle').value = '';
    document.getElementById('photo').value = '';
    document.getElementById('testimonial').value = '';
}

// Function to display the testimonials
function displayTestimonials() {
    // Get the container for the testimonials
    var testimonialList = document.getElementById('testimonialList');

    // Clear the container
    testimonialList.innerHTML = '';

    // Loop through the testimonials
    for (var i = 0; i < testimonials.length; i++) {
        // Create a new testimonial element
        var testimonialElement = document.createElement('div');
        testimonialElement.classList.add('col');

        // Create the inner testimonial div
        var testimonialDiv = document.createElement('div');
        testimonialDiv.classList.add('testimonial');

        // Create and append the img element
        var imgElement = document.createElement('img');
        imgElement.src = testimonials[i].photo;
        testimonialDiv.appendChild(imgElement);

        // Create and append the name element
        var nameElement = document.createElement('div');
        nameElement.classList.add('name');
        nameElement.textContent = testimonials[i].name;
        testimonialDiv.appendChild(nameElement);

        // Create and append the job title element
        var jobTitleElement = document.createElement('div');
        jobTitleElement.classList.add('jobTitle');
        jobTitleElement.textContent = testimonials[i].jobTitle;
        testimonialDiv.appendChild(jobTitleElement);

        // Create and append the stars element
        var starsElement = document.createElement('div');
        starsElement.classList.add('stars');
        starsElement.innerHTML = '<i class="fa fa-star"></i>'.repeat(5); // Add 5 stars
        testimonialDiv.appendChild(starsElement);

        // Create and append the testimonial text element
        var textElement = document.createElement('p');
        textElement.textContent = testimonials[i].testimonial;
        testimonialDiv.appendChild(textElement);

        // Append the testimonial div to the testimonial element
        testimonialElement.appendChild(testimonialDiv);

        // Append the testimonial element to the testimonial list
        testimonialList.appendChild(testimonialElement);
    }
}
