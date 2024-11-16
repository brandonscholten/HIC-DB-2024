<template>
    <div class="event-card">
      <!-- Event Info Section with Avatar -->
      <div class="event-main">
        <div class="event-info">
          <h2>{{ title }}</h2>
          <p>Organized by: {{ organizer }}</p>
          <p>{{ description }}</p>
  
          <!-- Button Container -->
          <div class="button-container">
            <button @click="attendEvent" class="attend-button">
              <span class="plus-icon">+</span> Attend
            </button>
            <button @click="togglePlaceInfo" class="info-button">
              Location
            </button>
          </div>
        </div>
  
        <!-- Avatar Image -->
        <div class="event-avatar">
          <img v-if="avatarUrl" :src="avatarUrl" alt="User Avatar" />
        </div>
      </div>
  
      <!-- Inline PlaceCard Section (expands below event information) -->
      <transition name="expand">
        <div v-if="showPlace" class="place-card">
          <div class="place-info">
            <h2>{{ placeTitle }}</h2>
            <p>{{ placeDescription }}</p>
  
            <!-- Rating -->
            <div class="rating">
              <span v-for="star in 5" :key="star" class="star">
                {{ star <= placeRating ? '★' : '☆' }}
              </span>
            </div>
  
            <!-- Google Maps Link -->
            <a :href="placeMapsLink" target="_blank" class="maps-link">View on Google Maps</a>
  
            <!-- More Info Button -->
            <button @click="toggleMoreInfo" class="more-info-button">More Info</button>
          </div>
  
          <!-- Main Image as Background -->
          <div class="place-image" :style="{ backgroundImage: `url(${placeImagePath})` }"></div>
  
          <!-- Additional Information Modal -->
          <div v-if="showMoreInfo" class="modal-overlay" @click="toggleMoreInfo">
            <div class="modal-content" @click.stop>
              <h3>More About {{ placeTitle }}</h3>
              <p>{{ placeExtendedDescription }}</p>
              <ul>
                <li v-for="(detail, index) in placeExtraDetails" :key="index">{{ detail }}</li>
              </ul>
              <button @click="toggleMoreInfo" class="close-button">Close</button>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
    name: "EventCard",
    props: {
      title: { type: String, required: true },
      organizer: { type: String, required: true },
      description: { type: String, required: true },
      avatarUrl: { type: String, default: '' },
      // Place-related props
      placeTitle: { type: String, default: null },
      placeDescription: { type: String, default: null },
      placeRating: { type: Number, default: null },
      placeMapsLink: { type: String, default: null },
      placeImagePath: { type: String, default: null },
      placePreviewImagePath: { type: String, default: null },
      placeExtendedDescription: { type: String, default: null },
      placeExtraDetails: { type: Array, default: () => [] },
    },
    setup() {
      const showPlace = ref(false); // Starts as false
      const showMoreInfo = ref(false); // Starts as false
  
      const togglePlaceInfo = () => {
        showPlace.value = !showPlace.value; // Toggle visibility
      };
  
      const toggleMoreInfo = () => {
        showMoreInfo.value = !showMoreInfo.value; // Toggle visibility
      };
  
      return {
        showPlace,
        showMoreInfo,
        togglePlaceInfo,
        toggleMoreInfo,
      };
    },
    methods: {
      attendEvent() {
        console.log(`Attending event: ${this.title}`);
      },
    },
  };
  </script>
  
  <style scoped>
  /* EventCard and PlaceCard styles */
  .event-card {
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: rgba(255, 255, 255, 0.574);
  }
  
  .event-main {
    display: flex;
    align-items: center;
  }
  
  .event-info {
    flex: 1;
    color: black;
  }
  
  .button-container {
    display: flex;
    gap: 10px;
    margin-top: 10px;
  }
  
  .attend-button,
  .info-button {
    display: flex;
    align-items: center;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 6px 12px;
    cursor: pointer;
  }
  
  .event-avatar {
    margin-left: 20px;
  }
  
  .event-avatar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }
  
  /* PlaceCard Styles */
  .place-card {
    display: flex;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-top: 10px;
    overflow: hidden;
    background-color: rgba(255, 255, 255, 0.54);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .place-info {
    flex: 1.5;
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: black;
  }
  
  .place-info h2 {
    color: black;
    font-size: 1.5em;
    margin: 0;
  }
  
  .rating {
    display: flex;
    font-size: 1.2em;
    color: #ffd700;
  }
  
  .maps-link {
    color: #007bff;
    text-decoration: none;
    margin-top: 8px;
  }
  
  .more-info-button {
    margin-top: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
  }
  
  .place-image {
    flex: 1.5;
    background-size: cover;
    background-position: center;
    border-left: 1px solid #ddd;
  }
  
  /* Modal Styles */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .modal-content {
    background-color: rgba(221, 221, 221, 0.777);
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 500px;
    color: black;
    text-align: center;
  }
  
  .close-button {
    margin-top: 20px;
    background-color: #ff5f5f;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
  }
  </style>
  