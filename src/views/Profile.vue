<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

// Mock profile data (replace with API call in a real application)
const profileData = ref({
  name: 'James Smith',
  pronouns: 'He/him',
  age: 33,
  hobbies: ['hobby1', 'hobby2', 'hobby3'],
  interests: ['interest1', 'interest2', 'interest3'],
  allergies: ['peanut-allergy'],
  profilePictureUrl: 'https://via.placeholder.com/150' // Placeholder image URL
});

// Fetch profile data on component mount (optional)
onMounted(() => {
  // Fetch data from API if necessary
  console.log("Profile data loaded:", profileData.value);
});

function goToEditProfile() {
  router.push('/edit-profile');
}
</script>

<template>
  <div class="profile-page">
    <h2>Profile</h2>
    <div class="profile-card">
      <!-- Profile Picture with Add Button -->
      <div class="profile-picture-container">
        <img :src="profileData.profilePictureUrl" alt="Profile Picture" class="profile-picture" />
        <div class="add-button">+</div>
      </div>
      
      <!-- User Info -->
      <div class="user-info">
        <p class="user-name">{{ profileData.name }} <span class="user-pronouns">{{ profileData.pronouns }}</span></p>
        <p class="user-age">Age: {{ profileData.age }}</p>
      </div>

      <!-- Hobbies, Interests, and Allergies -->
      <div class="profile-details">
        <div class="profile-section">
          <strong>Hobbies</strong>
          <p v-for="hobby in profileData.hobbies" :key="hobby" class="tag">#{{ hobby }}</p>
        </div>
        <div class="profile-section">
          <strong>Interests</strong>
          <p v-for="interest in profileData.interests" :key="interest" class="tag">#{{ interest }}</p>
        </div>
        <div class="profile-section">
          <strong>Allergies/Food Restrictions</strong>
          <p v-for="allergy in profileData.allergies" :key="allergy" class="tag">#{{ allergy }}</p>
        </div>
      </div>

      <!-- Edit Button -->
      <button class="edit-button" @click="goToEditProfile">Edit</button>
    </div>
  </div>
</template>

<style scoped>
/* Overall Page Styling */
.profile-page {
  max-width: 600px;
  margin: auto;
  padding: 2rem;
  background-color: #a0dbe6;
  font-family: Arial, sans-serif;
}

h2 {
  text-align: left;
  font-size: 2rem;
  color: #333;
  margin-bottom: 1rem;
}

/* Profile Card Styling */
.profile-card {
  background-color: #ffffff;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  position: relative;
}

/* Profile Picture with Add Button */
.profile-picture-container {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1rem;
}

.profile-picture {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  border: 2px solid #333;
  object-fit: cover;
}

.add-button {
  position: absolute;
  bottom: 10px;
  right: 10px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: #333;
  color: #fff;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

/* User Info */
.user-info {
  text-align: left;
  margin-bottom: 1rem;
}

.user-name {
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
}

.user-pronouns {
  font-size: 0.9rem;
  color: #666;
  margin-left: 0.5rem;
}

.user-age {
  font-size: 1rem;
  color: #333;
}

/* Profile Details (Hobbies, Interests, Allergies) */
.profile-details {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.profile-section {
  text-align: left;
}

.profile-section strong {
  display: block;
  font-size: 1.1rem;
  color: #333;
  margin-bottom: 0.5rem;
}

.tag {
  display: inline;
  font-size: 0.9rem;
  color: #333;
  margin-right: 0.5rem;
}

/* Edit Button */
.edit-button {
  position: absolute;
  top: 15px;
  right: 15px;
  padding: 0.3rem 0.6rem;
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.edit-button:hover {
  background-color: #555;
}
</style>
