  // Array of image links
  const imageLinks = [
    'https://be18.in/public/uploads/20231107/2d0e0bf574062c994427f4a7b05ad647.png',
'https://be18.in/public/uploads/20231107/b0ba278590303cdb7279a9e4aaeee79a.png',
'https://be18.in/public/uploads/20231107/8c06299b7539762519cbd35ea8a5f494.png',
'https://be18.in/public/uploads/20231107/40700c84ddce61503cd0d2ec347511eb.png',
'https://be18.in/public/uploads/20231107/b5b293c4839daf60059aa12cbd3430e5.png',
    // Add more image links as needed
  ];

  // Get the section element by ID
  const section = document.getElementById('sign_5');

  // Loop to generate and insert image elements
  for (let i = 0; i < imageLinks.length; i++) {
    // Create a container div
    const container = document.createElement('div');
    container.classList.add('w-4/5', 'md:w-1/3', 'mb-2', 'md:mb-0', 'relative');

    // Create the inner HTML structure
    container.innerHTML = `
      <div class="w-260p rounded-md md:w-full overflow-hidden">
          <div class="rounded-md">
              <div class="inline-block overflow-hidden w-full md:h-48 h-36">
                  <a>
                      <img class="w-full h-full rounded-md block object-cover"
                          src="${imageLinks[i]}"
                          alt="Image ${i + 1}">
                  </a>
              </div>
          </div>
      </div>
      <div class="absolute left-2.5 top-2.5 h-7 w-10 bg-opacity rounded md:left-4 md:w-11">
      </div>
    `;

    // Append the container to the section
    section.appendChild(container);
  }