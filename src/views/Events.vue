<template>
  <div id="app">
    <div class="content">
      <div id="events">
        <!-- First Column -->
        <div class="column">
          <div v-for="(event, index) in firstHalf" :key="index" class="event">
            <EventCard
              :title="event.event_name"
              :organizer="event.organizer_name"
              :description="event.event_description"
              :avatarUrl="event.organizer_photo"
              :placeTitle="event.place_name"
              :placeDescription="event.place_description"
              :placeRating="event.rating"
              :placeMapsLink="event.link_to_google_maps"
              :placeImagePath="event.primary_photo"
              :placePreviewImagePath="event.primary_photo"
              :placeExtendedDescription="event.place_description"
              placeExtraDetails=""
            />
          </div>
        </div>

        <!-- Second Column -->
        <div class="column">
          <div v-for="(event, index) in secondHalf" :key="index" class="event">
            <EventCard
              :title="event.event_name"
              :organizer="event.organizer_name"
              :description="event.event_description"
              :avatarUrl="event.organizer_photo"
              :placeTitle="event.place_name"
              :placeDescription="event.place_description"
              :placeRating="event.rating"
              :placeMapsLink="event.link_to_google_maps"
              :placeImagePath="event.primary_photo"
              :placePreviewImagePath="event.primary_photo"
              :placeExtendedDescription="event.place_description"
              placeExtraDetails=""
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import EventCard from '@/components/EventCard.vue';

// const events = ref([
//   { 
//     name: 'Map Collection', 
//     organizer: 'Explorer Tim', 
//     description: 'Exploring and collecting maps from around the world', 
//     avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
//     placeTitle: 'Place one', 
//     placeDescription: null, 
//     placeRating: null, 
//     placeMapsLink: null, 
//     placeImagePath: null, 
//     placePreviewImagePath: null, 
//     placeExtendedDescription: null,  
//     placeExtraDetails: null 
//   },
//   { 
//     name: 'Mysterious Map Collection', 
//     organizer: 'Explorer Tim', 
//     description: 'Exploring and collecting mysterious maps from around the world', 
//     avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
//     placeTitle: null, 
//     placeDescription: null, 
//     placeRating: null, 
//     placeMapsLink: null, 
//     placeImagePath: null, 
//     placePreviewImagePath: null, 
//     placeExtendedDescription: null,  
//     placeExtraDetails: null 
//   },
//   { 
//     name: 'Fun Map Collection', 
//     organizer: 'Explorer Tim', 
//     description: 'Exploring and collecting fun maps from around the world', 
//     avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
//     placeTitle: null, 
//     placeDescription: null, 
//     placeRating: null, 
//     placeMapsLink: null, 
//     placeImagePath: null, 
//     placePreviewImagePath: null, 
//     placeExtendedDescription: null,  
//     placeExtraDetails: null 
//   },
//   { 
//     name: 'Cool Map Collection', 
//     organizer: 'Explorer Tim', 
//     description: 'Exploring and collecting cool maps from around the world', 
//     avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
//     placeTitle: null, 
//     placeDescription: null, 
//     placeRating: null, 
//     placeMapsLink: null, 
//     placeImagePath: null, 
//     placePreviewImagePath: null, 
//     placeExtendedDescription: null,  
//     placeExtraDetails: null 
//   }
// ]);

const events = ref({});

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

// Split the events array into two halves
const firstHalf = computed(() => {
  return events.value.slice(0, Math.ceil(events.value.length / 2));
});

const secondHalf = computed(() => {
  return events.value.slice(Math.ceil(events.value.length / 2));
});

onMounted(async () => {
  //API call to get a list of all events
  try {
    const response = await fetch('http://localhost:5941/get_events');
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const json = await response.json();
    const res = JSON.parse(json.response);
    events.value = res;
  } catch (error) {
    console.error(error.message);
  }
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

#events {
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
