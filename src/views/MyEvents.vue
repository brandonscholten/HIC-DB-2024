<template>
  <div id="app">
    <h1>My Events</h1>

    <div class="content">
      <div id="events">
        <!-- First Column with Create Event Form -->
        <div class="column">
          <div class="create-event-box">
            <h2>Create Event</h2>
            <form @submit.prevent="createEvent">
              <div class="form-group">
                <label for="name">Event Name:</label>
                <input type="text" id="name" v-model="events.name" placeholder="Enter event name" required />
              </div>
              
              <div class="timedate-column">
                <!-- Date Picker Field -->
                <div class="form-group">
                  <label for="date">Event Date:</label>
                  <input type="date" id="date" v-model="events.date" required />
                </div>

                <!-- Time Picker Field -->
                <div class="form-group">
                  <label for="time">Event Time:</label>
                  <input type="time" id="time" v-model="events.time" required />
                </div>
              </div>

              <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="organizer" v-model="events.organizer" placeholder="Enter organizer name" required />
              </div>

              <div class="timedate-column">
              <!-- Event Type Dropdown and 21+ Field -->
                <div class="form-group">
                  <label for="eventType">What type of event is this?</label>
                  <select id="eventType" v-model="events.eventType" required>
                    <option value="" disabled selected>Select event type</option>
                    <option value="Conference">Conference</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Party">Party</option>
                    <option value="Concert">Concert</option>
                    <option value="Meetup">Meetup</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="is21Plus">Is this event 21+?</label>
                  <input type="checkbox" id="is21Plus" v-model="events.is21Plus" />
                </div>

            </div>

              <div class="form-group">
                <label for="description">Add tags to reach users with mutual interests!</label>
                <textarea id="description" v-model="events.description" placeholder="Enter event description" required></textarea>
              </div>

              <button type="submit">Post Event</button>

            </form>
          </div>
        </div>

        <!-- Second Column displaying Events -->
        <div class="column">
          <div v-for="(event, index) in events" :key="index" class="event">
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
import { ref } from 'vue';
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
]);

</script>

<style scoped>
label {
  color: black;
  padding-bottom: 10px;
}

h2 {
  color: black;
}

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

.timedate-column {
  display: flex;            
  align-items: center;      
  gap: 20px;                
}

.create-event-box {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.create-event-box h2 {
  font-size: 1.5rem;
  margin-bottom: 15px;
}

.form-group {
  display: flex;
  flex-direction: column;
  padding-top: 10px;
  padding-bottom: 10px;
}

.form-group label {
  display: block;
  font-weight: bold;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-group textarea {
  resize: vertical;
  min-height: 100px;
}

button {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
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
    margin-bottom: 10px;
  }
}
</style>
