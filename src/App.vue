<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router';
import { ref } from 'vue';
import Button from 'primevue/button';

const router = useRouter();
const activeButton = ref(null);

const navigate = (route, name) => {
  activeButton.value = name;
  router.push(route);
};

let loggedIn = ref(true);

</script>

<template>
  <nav>
    <div class="nav-left">
      <router-link to="/">
        <svg width="125" height="50" xmlns="http://www.w3.org/2000/svg">
          <text x="10" y="40" font-family="Arial" font-size="40" fill="white">K-GO</text>
        </svg>
      </router-link>
      <Button @click="navigate('/places', 'places')" :class="['left-button', { pressed: activeButton === 'places' }]"  text>Places</Button>
      <Button @click="navigate('/events', 'events')" :class="['right-button', { pressed: activeButton === 'events' }]" text>Events</Button>
    </div>
    <div class="nav-right">
      <div class="login-links" v-if="!loggedIn">
        <router-link>login</router-link>
        |
        <router-link to="/edit-profile">create account</router-link>
      </div>
      <div v-else>
        <!-- <router-link to="/favorite-places">My Places</router-link>
        <router-link to="/my-events">My Events</router-link> -->
        <Button @click="navigate('/favorite-places', 'favorite-places')" :class="['left-button', { pressed: activeButton === 'favorite-places' }]" text>My Places</Button>
        <Button @click="navigate('/my-events', 'my-events')" :class="['right-button', { pressed: activeButton === 'my-events' }]" text>My Events</Button>
        <router-link to="/profile">My Profile</router-link>
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
