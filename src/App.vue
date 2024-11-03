<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router';
import { ref } from 'vue';
import Button from 'primevue/button';
import Avatar from 'primevue/avatar';

const router = useRouter();
const activeButton = ref(null);
let loggedIn = ref(false);

const navigate = (route, name) => {
  activeButton.value = name;
  router.push(route);
};

const login = async () => {
  //get email and password from user TODO: create a real login modal
  let email = prompt("email:");
  let password = prompt("password:");
  //send email and password to the flask server TODO: change url to a publicly available address
  const url = 'http://localhost:5000/login/'+email+'/'+password //TODO: password should not be plaintext lol
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    console.log(json);
    //save the session ID as a cookie
    document.cookie = "session_id="+json.session_id+";"
    loggedIn.value = true;
    navigate('/places');
  } catch (error) {
    console.error(error.message);
  }
} 

</script>

<template>
  <nav>
    <div class="nav-left">
        <svg @click="navigate('/')" width="125" height="50" xmlns="http://www.w3.org/2000/svg">
          <text x="10" y="40" font-family="Arial" font-size="40" fill="white">K-GO</text>
        </svg>
      <Button @click="navigate('/places', 'places')" :class="['left-button', { pressed: activeButton === 'places' }]"  text>Places</Button>
      <Button @click="navigate('/events', 'events')" :class="['right-button', { pressed: activeButton === 'events' }]" text>Events</Button>
    </div>
    <div class="nav-right">
      <div class="login-links" v-if="!loggedIn">
        <a @click="login()">login</a>
        |
        <router-link to="/edit-profile">create account</router-link>
      </div>
      <div v-else style="display: flex; align-items: center;" >
        <Button @click="navigate('/favorite-places', 'favorite-places')" :class="['left-button', { pressed: activeButton === 'favorite-places' }]" text>My Places</Button>
        <Button @click="navigate('/my-events', 'my-events')" :class="['right-button', { pressed: activeButton === 'my-events' }]" text>My Events</Button>
        <!-- <router-link to="/profile">My Profile</router-link> -->
        <Avatar image="../public/favicon.ico" class="mr-2" size="large" shape="circle" @click="navigate('/profile')" style="background-color: white; margin: 10px; size: 40px;"/>
      </div>
    </div>
  </nav>
  <RouterView />
</template>

<style scoped>

nav{
  display: flex;
  flex-direction: row;
  background-image: linear-gradient(#008D9D, #00000000);
}
.nav-left{
  display: flex;
  width: 50%;
  align-items: center;
  flex-direction: row;
}
.nav-right{
  width: 50%;
  display: flex;
  flex-direction: row-reverse;
  align-items: center;
}
a{
  color: white;
  margin: 10px;
  text-decoration: underline; 
  cursor: pointer; 
} 
Button{
  color: black;
  background-color: white;
  border-radius: 0;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}
.pressed{
  box-shadow: none !important;
}
.left-button{
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}
.right-button{
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}
</style>
