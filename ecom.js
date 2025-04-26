let currentIndex = 0;
const slides = document.getElementById("slides");
const totalSlides = slides.children.length;

function showSlide(index) {
  if (index >= totalSlides) currentIndex = 0;
  else if (index < 0) currentIndex = totalSlides - 1;
  else currentIndex = index;
  slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextSlide() {
  showSlide(currentIndex + 1);
}

function prevSlide() {
  showSlide(currentIndex - 1);
}

// Auto slide every 4 seconds
setInterval(nextSlide, 4000);

// Overlay functions
function toggleOverlay(type) {
  document.getElementById("overlay").style.display = "flex";
  document.getElementById("formTitle").innerText =
    type === "signup" ? "Sign Up" : "Login";
}

function closeOverlay() {
  document.getElementById("overlay").style.display = "none";
}

// showing product detal
function showProductDetail(name, imageUrl, description) {
  const content = document.querySelector(".content");
  content.innerHTML = `
      <div class="product-detail">
        <button onclick="location.reload()" class="back-btn">← Back</button>
        <img src="${imageUrl}" alt="${name}" />
        <h2>${name}</h2>
        <p>${description}</p>
        <button class="add-btn">Add to Cart</button>
      </div>
    `;
}

function addToCart(productId) {
  fetch("add_to_cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `product_id=${productId}&quantity=1`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Added to cart!");
      } else {
        alert("Something went wrong.");
      }
    });
}
