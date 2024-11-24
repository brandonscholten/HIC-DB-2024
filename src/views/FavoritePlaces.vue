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
import { ref, onMounted, computed } from 'vue';
import EventCard from '@/components/EventCard.vue';

const places = ref([]);

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

onMounted(async () => {
  //API call to get a list of favorite places
  if (getCookie('session_id')) {
    try {
      const response = await fetch('http://localhost:5941/get_favorite_places/?session_id='+getCookie('session_id'));
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
      const json = await response.json();
      const res = JSON.parse(json.response);
      events.value = res;
    } catch (error) {
      console.error(error.message);
    }
  } else {
    alert('no valid session!');
  }
});

// Split the events array into two halves
const firstHalf = computed(() => {
  return events.value.slice(0, Math.ceil(events.value.length / 2));
});

const secondHalf = computed(() => {
  return events.value.slice(Math.ceil(events.value.length / 2));
});

</script>

<style scoped>

h1 {
  font-family: Arial;
  text-align: left;
}

#app {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.content {
  
  padding-bottom: 50px;
  display: flex;
  justify-content: space-between;
  width: 100%;
  max-width: 1500px;
}

#places {
  display: flex;
  justify-content: space-between;
  width: 100%;
  margin-left: 100px;
  margin-right: 100px;
}

.column {
  width: 50%;
  margin: 25px;
}

.event {
  margin-bottom: 20px;
}

@media screen and (max-width: 1050px) {
  #events {
  display: flex;
  margin: 25px;
  justify-content: space-between;
  width: 100%;
  margin-left: 0px;
  margin-right: 0px;
}

  .column {
    width: 100%;
    min-width: 300px;
    margin: 25px;
  }
}

@media screen and (max-width: 800px) {
  #events {
    flex-direction: column;
    margin: 25px;
    align-items: center;
    flex-wrap: nowrap;
    width: 100%;
  }

  .column {
    width: 100%;
    min-width: 300px;
    margin: 0px;
  }
}
</style>
