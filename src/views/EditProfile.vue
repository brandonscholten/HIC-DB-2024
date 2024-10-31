<script setup>
import { ref } from 'vue';

// Define reactive data for the form fields
const profileData = ref({
  name: '',
  email: '',
  bio: ''
});
const profilePictureUrl = ref(null);

// Method to handle form submission
function submitProfile() {
  // Here, you'd include the logic to send `profileData` to your backend
  console.log("Profile data submitted:", profileData.value);
}

// Method to handle profile picture selection
function onFileChange(event) {
  const file = event.target.files[0];
  if (file) {
    profilePictureUrl.value = URL.createObjectURL(file);
  }
}
</script>

<template>
  <div class="edit-profile">
    <h2>Edit Profile</h2>
    <form @submit.prevent="submitProfile">
      <!-- Profile Picture -->
      <div class="form-group">
        <label for="profilePic">Profile Picture</label>
        <input type="file" id="profilePic" @change="onFileChange" />
        <img v-if="profilePictureUrl" :src="profilePictureUrl" alt="Profile Picture" class="profile-picture" />
      </div>

      <!-- Name Field -->
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" v-model="profileData.name" required />
      </div>

      <!-- Email Field -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="profileData.email" required />
      </div>

      <!-- Bio Field -->
      <div class="form-group">
        <label for="bio">Bio</label>
        <textarea id="bio" v-model="profileData.bio"></textarea>
      </div>

      <!-- Save Button -->
      <button type="submit">Save Changes</button>
    </form>
  </div>
</template>

<style scoped>
.edit-profile {
  max-width: 400px;
  margin: auto;
  padding: 1rem;
  background-color: #ffffff;
  color: black;
  border-radius: 8px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}
.form-group {
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
}
.profile-picture {
  margin-top: 10px;
  max-width: 100px;
  height: auto;
  border-radius: 50%;
}
button[type="submit"] {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
