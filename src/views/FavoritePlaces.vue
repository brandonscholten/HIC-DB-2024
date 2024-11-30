<template>
  <div id="app">
    <div class="content">
      <div id="places">
        <div v-for="place in places" class="place">
          <PlaceCard
            :title = place.name
            :description = place.description
            :rating= place.rating
            :mapsLink= place.mapsLink
            :imagePath="place.image"
            :extendedDescription= place.description
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';
import PlaceCard from '@/components/PlaceCard.vue';

const loggedIn = inject('loggedIn');

const places = ref([]);

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie() {
  let allCookies = document.cookie.split(';');
  for (let i = 0; i< allCookies.length; i++) {
    document.cookie = allCookies[i] + "=;expires=" + new Date(0).toUTCString();
  }
}

onMounted(async () => {
  //API call to get a list of favorite places
  if (getCookie('session_id')) {
    loggedIn.value = true;
    try {
      const response = await fetch('http://localhost:5941/get_favorite_places/?session_id='+getCookie('session_id'));
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
      const json = await response.json();
      const res = JSON.parse(json.response);
      places.value = res;
    } catch (error) {
      console.error(error.message);
    }
  } else {
    alert('no valid session!');
    deleteCookie();
  }
});

</script>

<style scoped>

body {
  font-family: Arial, sans-serif;
  padding: 20px;
  background-color: #f4f4f9;
}

#app {
  display: flex;
  flex-direction: column;
  align-items: center;
}

h1 {
  font-size: 2rem;
  color: #333;
}

.content {
  padding-top: 50px;
  padding-bottom: 50px;
  display: flex;
  justify-content: space-around;
  width: 100%;
  max-width: 1500px;
}

#places {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin-left: 10px;
  gap: 20px;
  width: 100%;
}

.place {
  flex: 1 1 calc(50% - 20px);
  max-width: calc(50% - 20px);
  box-sizing: border-box;
}

@media screen and (max-width: 1222px) {
  .content{
    flex-direction: column;
    overflow: hidden;
  }
}

@media screen and (max-width: 920px) {
  #places {
    flex-direction: column;
    align-items: stretch;
    flex-wrap: nowrap;
    width: 100%;
  }
  .place {
    flex: 1 1 calc(100% - 20px);
    max-width: calc(100% - 20px);
  }
}

</style>
