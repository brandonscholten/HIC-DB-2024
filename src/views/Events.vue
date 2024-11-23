<template>
  <div id="app">

    <h1>Events</h1>

    <div class="content">
      <div id="events">
        <!-- First Column -->
        <div class="column">
          <div v-for="(event, index) in firstHalf" :key="index" class="event">
            <EventCard
              :title="event.name"
              :organizer="event.organizer"
              :description="event.description"
              :avatarUrl="event.avatarUrl"
              :placeTitle="event.placeTitle"
              :placeDescription="event.placeDescription"
              :placeRating="event.placeRating"
              :placeMapsLink="event.placeMapsLink"
              :placeImagePath="event.placeImagePath"
              :placePreviewImagePath="event.placePreviewImagePath"
              :placeExtendedDescription="event.placeExtendedDescription"
              :placeExtraDetails="event.placeExtraDetails"
            />
          </div>
        </div>

        <!-- Second Column -->
        <div class="column">
          <div v-for="(event, index) in secondHalf" :key="index" class="event">
            <EventCard
              :title="event.name"
              :organizer="event.organizer"
              :description="event.description"
              :avatarUrl="event.avatarUrl"
              :placeTitle="event.placeTitle"
              :placeDescription="event.placeDescription"
              :placeRating="event.placeRating"
              :placeMapsLink="event.placeMapsLink"
              :placeImagePath="event.placeImagePath"
              :placePreviewImagePath="event.placePreviewImagePath"
              :placeExtendedDescription="event.placeExtendedDescription"
              :placeExtraDetails="event.placeExtraDetails"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import EventCard from '@/components/EventCard.vue';

const events = ref([
  { 
    name: 'Map Collection', 
    organizer: 'Explorer Tim', 
    description: 'Exploring and collecting maps from around the world', 
    avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
    placeTitle: 'Place one', 
    placeDescription: null, 
    placeRating: null, 
    placeMapsLink: null, 
    placeImagePath: null, 
    placePreviewImagePath: null, 
    placeExtendedDescription: null,  
    placeExtraDetails: null 
  },
  { 
    name: 'Mysterious Map Collection', 
    organizer: 'Explorer Tim', 
    description: 'Exploring and collecting mysterious maps from around the world', 
    avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
    placeTitle: null, 
    placeDescription: null, 
    placeRating: null, 
    placeMapsLink: null, 
    placeImagePath: null, 
    placePreviewImagePath: null, 
    placeExtendedDescription: null,  
    placeExtraDetails: null 
  },
  { 
    name: 'Fun Map Collection', 
    organizer: 'Explorer Tim', 
    description: 'Exploring and collecting fun maps from around the world', 
    avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
    placeTitle: null, 
    placeDescription: null, 
    placeRating: null, 
    placeMapsLink: null, 
    placeImagePath: null, 
    placePreviewImagePath: null, 
    placeExtendedDescription: null,  
    placeExtraDetails: null 
  },
  { 
    name: 'Cool Map Collection', 
    organizer: 'Explorer Tim', 
    description: 'Exploring and collecting cool maps from around the world', 
    avatarUrl: 'https://cdn.pixabay.com/photo/2019/12/15/12/32/things-4697014_640.png',
    placeTitle: null, 
    placeDescription: null, 
    placeRating: null, 
    placeMapsLink: null, 
    placeImagePath: null, 
    placePreviewImagePath: null, 
    placeExtendedDescription: null,  
    placeExtraDetails: null 
  }
]);

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
