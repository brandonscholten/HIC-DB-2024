<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router';
import Button from 'primevue/button';
</script>

<template>
  <!-- Image Container with Overlay Text and Right-Aligned Content Box -->
  <div class="image-container">
    <img src="@/assets/20ALR367_UniversityEvents_1500x600_1.jpg" alt="Kent Ohio" class="full-width-image" />
    <!-- Tint Overlay -->
    <div class="tint-overlay"></div>
    <div class="overlay-text">Kent, Go Outside!</div>
  </div>
  <!-- Right-Aligned Content Box -->
  <div class="centered-content">
    <h1 style="font-size: 36pt;">Our Mission</h1>
    <p style="font-size: 18pt;">
      Welcome to K-Go! The wonderful city of Kent, Ohio has a lot to offer. From restaurants and bars, to cafes, and parks there is something for everyone.
      Explore places, events, and meet new people.
    </p>
    <RouterLink to="/edit-profile">
      <Button label="Get Started" severity="success" size="large" rounded />
    </RouterLink>
  </div>
</template>

<style scoped>

.image-container {
  display: flex;
  position: relative;
  width: 100%;
  height: 60vh;
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
  display: flex;
  flex-direction: column;
  justify-content: center; /* Center vertically */
  background-color: rgba(255, 255, 255, 0.8);
  color: black;
  border-radius: 8px;
  width: 50%;
  padding: 20px;
  position: absolute;
  top: 50%; /* Start from the center */
  right: 10%; /* Position on the right side */
  transform: translateY(-10%); /* Center it vertically */
  z-index: 1;
}

.centered-content h1 {
  margin-bottom: 1rem;
}

.centered-content p {
  margin-bottom: 2rem;
}

@media screen and (max-width: 1222px) {
  .centered-content{
    width: 100%;
    background-color: white;
    margin: none;
    position: relative;
    border-radius: 0px;
    top: 20px;
    right: 0px;
  }
}

</style>
