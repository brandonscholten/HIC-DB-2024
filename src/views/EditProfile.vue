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
        <img v-if="profilePictureUrl" :src="profilePictureUrl" alt="Profile Picture" />
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
}
.form-group {
  margin-bottom: 1rem;
}
</style>
