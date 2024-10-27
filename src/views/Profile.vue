<script setup>
import { ref, onMounted } from 'vue';

// Mock profile data (replace with API call in a real application)
const profileData = ref({
  name: 'John Doe',
  email: 'johndoe@example.com',
  bio: 'Software developer with a passion for open-source projects and teaching others.',
  profilePictureUrl: 'https://via.placeholder.com/150' // Placeholder image URL
});

// Fetch profile data on component mount (optional)
onMounted(() => {
  // Fetch data from API if necessary
  console.log("Profile data loaded:", profileData.value);
});
</script>

<template>
  <div class="profile">
    <h2>Profile</h2>
    <div class="profile-picture">
      <img :src="profileData.profilePictureUrl" alt="Profile Picture" />
    </div>
    <div class="profile-info">
      <p><strong>Name:</strong> {{ profileData.name }}</p>
      <p><strong>Email:</strong> {{ profileData.email }}</p>
      <p><strong>Bio:</strong> {{ profileData.bio }}</p>
    </div>
  </div>
</template>

<style scoped>
.profile {
  max-width: 400px;
  margin: auto;
  padding: 1rem;
  text-align: center;
}
.profile-picture img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
}
.profile-info p {
  margin: 0.5rem 0;
}
</style>
