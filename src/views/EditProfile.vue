<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const activeSession = ref(false);

const profileData = ref({
  name: '',
  pronouns: '',
  age: '',
  email: '',
  password: '',
  interests: '',
  allergies: '',
  hobbies: '',
  photo: ''
});

const profilePictureUrl = ref(null);

// the following function is from https://javascript.info/cookie
// returns the cookie with the given name,
// or undefined if not found
function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

const createProfile = async(profileData) => {
  //send request to create profile
  //then update session cookie 

  //construct url
  let interestString = ""; 
  let restrictionString = "";

  let interests = profileData.interests.slice(1).split(" #");
  let restrictions = profileData.allergies.slice(1).split(" #");

  for (let interest in interests) {
    interestString += "&interest="+interests[interest];
  }

  for (let restriction in restrictions) {
    restrictionString += "&restriction="+restrictions[restriction];
  }

  const url = (
    'http://localhost:5000/create_user/?name='
    + profileData.name + '&email=' + profileData.email
    + '&password=' + profileData.password
    + '&pronouns=' + profileData.pronouns
    + '&age=' + profileData.age + '&photo=' + profileData.photo
    + interestString + restrictionString
  );

  //send request
  try { 
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    //set cookie
    document.cookie = "session_id="+JSON.parse(json.session_message).session_id+";";
  } catch (error) {
    console.error(error.message);
  }

}

const updateProfile = async(profileData) => {
  //TODO send request to update profile
  //     this might not need to be a separate function
  console.log('this does nothing for now');
}

async function submitProfile() {
  console.log("Profile data submitted:", profileData.value);
  if (getCookie("session_id")) {
    //TODO: if there is a session token stored, attempt to update the account
    await updateProfile(profileData.value);
  } else {
    //if there is not a session token stored, create a new account
    await createProfile(profileData.value);
  }
  router.push('/profile');
}

function onFileChange(event) {
  const file = event.target.files[0];
  if (file) {
    profilePictureUrl.value = URL.createObjectURL(file);
  }
}

onMounted(() => {
  if (getCookie("session_id")) {
    //TODO: if a session token is stored, attempt to define profileData.value
    console.log('there is a session token');
  }
});


</script>

<template>
  <div class="edit-profile">
    <h2>Profile Information</h2>
    <form @submit.prevent="submitProfile">
      <!-- Name, Pronouns, and Age Fields -->
      <div class="row">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" v-model="profileData.name" required />
        </div>
        <div class="form-group">
          <label for="pronouns">Pronouns</label>
          <input type="text" id="pronouns" v-model="profileData.pronouns" />
        </div>
        <div class="form-group">
          <label for="age">Age</label>
          <input type="number" id="age" v-model="profileData.age" min="0" />
        </div>
      </div>

      <!-- Email and Password Fields -->
      <div class="row">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="profileData.email" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="profileData.password" required />
        </div>
      </div>

      <!-- Profile Picture Field -->
      <div class="form-group profile-pic-group">
        <label>Profile Photo</label>
        <div class="profile-pic-container">
          <input type="file" @change="onFileChange" />
          <img v-if="profilePictureUrl" :src="profilePictureUrl" alt="Profile Picture" class="profile-picture" />
        </div>
      </div>

      <!-- Interests, Allergies, and Hobbies Fields -->
      <div class="row">
        <div class="form-group">
          <label for="interests">Interests</label>
          <textarea id="interests" v-model="profileData.interests"></textarea>
        </div>
        <div class="form-group">
          <label for="allergies">Allergies/Food Restrictions</label>
          <textarea id="allergies" v-model="profileData.allergies"></textarea>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<style scoped>
.edit-profile {
  max-width: 600px;
  margin: 100px auto;
  padding: 1rem;
  background-color: #e0f2f1;
  color: #004d40;
  border-radius: 8px;
}

h2 {
  text-align: center;
  color: #004d40;
}

.form-group {
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
}

.row {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
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
  width: 100%;
}

.profile-pic-group {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 1rem;
}

.profile-pic-container {
  position: relative;
  display: inline-block;
  width: 100px;
  height: 100px;
  background-color: #f9f9f9;
  border: 2px solid #ccc;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: #aaa;
}

.profile-picture {
  width: 100px;
  height: 100px;
  border-radius: 50%;
}

button[type="submit"] {
  width: 100%;
  padding: 0.5rem;
  border: none;
  border-radius: 4px;
  background-color: #004d40;
  color: #fff;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #00332c;
}
</style>
