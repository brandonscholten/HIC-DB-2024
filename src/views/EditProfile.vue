<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

// Define reactive data for the form fields
const profileData = ref({
  name: '',
  pronouns: '',
  age: '',
  email: '',
  password: '',
  interests: '',
  allergies: '',
  hobbies: '',
  bio: ''
});

const profilePictureUrl = ref(null);

// Method to handle form submission
function submitProfile() {
  console.log("Profile data submitted:", profileData.value);
}

// Navigate to the Profile page after saving
router.push('/edit-profile'); // Ensure '/profile' matches the path for Profile.vue in your router setup


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

      <!-- Pronouns Field -->
      <div class="form-group">
        <label for="pronouns">Pronouns</label>
        <input type="text" id="pronouns" v-model="profileData.pronouns" />
      </div>

      <!-- Age Field -->
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" id="age" v-model="profileData.age" min="0" />
      </div>

      <!-- Email Field -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="profileData.email" required />
      </div>

      <!-- Password Field -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="profileData.password" required />
      </div>

      <!-- Interests Field -->
      <div class="form-group">
        <label for="interests">Interests</label>
        <input type="text" id="interests" v-model="profileData.interests" />
      </div>

      <!-- Allergies and Food Restrictions Field -->
      <div class="form-group">
        <label for="allergies">Allergies and Food Restrictions</label>
        <input type="text" id="allergies" v-model="profileData.allergies" />
      </div>

      <!-- Hobbies Field -->
      <div class="form-group">
        <label for="hobbies">Hobbies</label>
        <input type="text" id="hobbies" v-model="profileData.hobbies" />
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

input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
textarea {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
  background-color: #f9f9f9;
  color: #333;
}

input[type="file"] {
  margin-top: 0.5rem;
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
