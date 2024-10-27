<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router';
import Button from 'primevue/button';
</script>

<template>
  <div>
    <!-- Image Container with Overlay Text and Right-Aligned Content Box -->
    <div class="image-container">
      <img src="@/assets/20ALR367_UniversityEvents_1500x600_1.jpg" alt="Kent Ohio" class="full-width-image" />
      <!-- Tint Overlay -->
      <div class="tint-overlay"></div>
      <div class="overlay-text">Kent, Go Outside!</div>
      
      <!-- Right-Aligned Content Box -->
      <div class="centered-content">
        <h1>Mission Statement</h1>
        <p>
          Welcome to K-Go! The wonderful city of Kent, Ohio has a lot to offer. From restaurants and bars, to cafes, and parks there is something for everyone.
          Explore places, events, and meet new people.
        </p>
        <RouterLink to="/editProfile">
          <Button label="Get Started" severity="success" size="large" rounded />
        </RouterLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
.image-container {
  position: relative;
  width: 100vw;
  overflow: hidden;
}

.full-width-image {
  width: 100%;
  height: auto;
  object-fit: cover;
}

.tint-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Adjust the rgba values for tint color and opacity */
  z-index: 0; /* Place it below the text and content box */
}

.overlay-text {
  position: absolute;
  bottom: 20px;
  left: 20px;
  font-size: 3rem;
  color: white;
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
  z-index: 1;
}

.centered-content {
  position: absolute;
  top: 50%; /* This positions the box to start from the center of the image */
  right: 20px; /* Position on the right side of the image */
  transform: translateY(-50%); /* Center vertically */
  background-color: rgba(255, 255, 255, 0.8); /* Translucent white background */
  color: black;
  padding: 3rem; /* Increased padding for more space */
  max-width: 400px; /* Increased max-width to make the box larger */
  border-radius: 8px; /* Optional: rounded corners */
  text-align: center;
  z-index: 2; /* Ensure the content box appears above the image */
  margin-top: 150px; /* Adjust this value to move the box down */
}

.centered-content h1 {
  margin-bottom: 1rem;
}

.centered-content p {
  margin-bottom: 2rem;
}
</style>
