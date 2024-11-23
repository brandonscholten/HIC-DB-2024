<!-- PlaceCard.vue -->
<template>
  <div class="place-card">
    <div class="place-info">
      <!-- Title and Description -->
      <h2>{{ title }}</h2>
      <p>{{ description }}</p>

      <!-- Rating -->
      <div class="rating">
        <span v-for="star in 5" :key="star" class="star">
          {{ star <= rating ? '★' : '☆' }}
        </span>
      </div>

      <!-- Google Maps Link -->
      <a :href="mapsLink" target="_blank" class="maps-link">View on Google Maps</a>

      <!-- More Info Button -->
      <button @click="toggleMoreInfo" class="more-info-button">More Info</button>
    </div>

    <!-- Main Image as Background -->
    <div class="place-image" :style="{ backgroundImage: `url(${imagePath})` }"></div>

    <!-- Additional Information Modal -->
    <div v-if="showMoreInfo" class="modal-overlay" @click="toggleMoreInfo">
      <div class="modal-content" @click.stop>
        <h3>More About {{ title }}</h3>
        <p>{{ extendedDescription }}</p>
        <ul>
          <li v-for="(detail, index) in extraDetails" :key="index">{{ detail }}</li>
        </ul>
        <button @click="toggleMoreInfo" class="close-button">Close</button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: "PlaceCard",
  props: {
    title: { type: String, required: true },
    description: { type: String, required: true },
    rating: { type: Number, required: true, validator: value => value >= 0 && value <= 5 },
    mapsLink: { type: String, required: true },
    imagePath: { type: String, required: true },
    extendedDescription: { type: String, required: true },
    extraDetails: { type: Array, default: () => [] },
  },
  setup() {
    const showMoreInfo = ref(false);

    const toggleMoreInfo = () => {
      showMoreInfo.value = !showMoreInfo.value;
    };

    return {
      showMoreInfo,
      toggleMoreInfo,
    };
  },
};
</script>

<style scoped>
/* PlaceCard Design */
.place-card {
  display: flex;
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-top: 10px;
  overflow: hidden;
  background-color: rgba(255, 255, 255, 0.54);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  /* max-width: 550px; */
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
