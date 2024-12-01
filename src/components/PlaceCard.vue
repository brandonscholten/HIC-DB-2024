<template>
  <div class="place-card">
    <!-- PlaceCard Section -->
    <div class="place-info">
      <div class="info-left">
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
      <div class="place-image" :style="placeImagePath ? { backgroundImage: `url(${placeImagePath})` } : {}"></div>
    </div>

    <!-- Additional Information Modal -->
    <div v-if="showMoreInfo" class="modal-overlay" @click="toggleMoreInfo">
      <div class="modal-content" @click.stop>
        <h3>More About {{ placeTitle }}</h3>
        <p>{{ placeExtendedDescription }}</p>

        <!-- Rating in More Info -->
        <div class="rating">
          <span v-for="star in 5" :key="star" class="star">
            {{ star <= placeRating ? '★' : '☆' }}
          </span>
        </div>

        <!-- Image Links Section -->
        <div class="image-links">
          <a v-for="(image, index) in bigPlaceImageLinks" :key="index" :href="image" target="_blank">
            <img :src="image" :alt="'Image ' + (index + 1)" class="preview-image" />
          </a>
        </div>

        <!-- Google Maps Embed -->
        <div class="maps-embed">
          <iframe
            :src="googleMapsEmbedUrl"
            width="100%"
            height="300"
            style="border: 0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

        <ul>
          <li v-for="(detail, index) in placeExtraDetails" :key="index">{{ detail }}</li>
        </ul>
        <button @click="toggleMoreInfo" class="close-button">Close</button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: "PlaceCardStandalone",
  props: {  
    placeTitle: { type: String, required: true },
    placeDescription: { type: String, default: null },
    placeRating: { type: Number, default: null },
    placeMapsLink: { type: String, default: null },
    placeImagePath: { type: String, default: null },
    placeExtendedDescription: { type: String, default: null },
    placeExtraDetails: { type: Array, default: () => [] },
    bigPlaceImageLinks: { type: Array, default: () => [] },
    googleMapsEmbedUrl: { type: String, default: '' },
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
/* PlaceCard Styles */
.place-card {
  display: flex;
  flex-direction: column;
  border: 1px solid #ddd;
  padding: 16px;
  border-radius: 8px;
  margin-bottom: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: rgba(255, 255, 255, 0.574);
  width: 100%;
  overflow: hidden;
}

.place-info {
  display: flex;
  align-items: center;
}

.info-left {
  flex: 1;
  padding: 16px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  color: black;
}

.rating {
  display: flex;
  font-size: 1.2em;
  color: #ffd700;
  margin: 10px 0;
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
  flex: 1;
  background-size: cover;
  background-position: center;
  height: 200px;
  border-radius: 8px;
}

/* Modal Styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, .8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.modal-content {
  background-color: rgba(221, 221, 221, 1);
  width: 80%;
  max-width: 700px;
  height: 80%;
  border-radius: 10px;
  padding: 20px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  color: black;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
  position: relative;
}

/* Close Button */
.close-button {
  position: absolute;
  top: 15px;
  right: 15px;
  background-color: #ff5f5f;
  color: white;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
  border-radius: 5px;
  z-index: 10000;
}

/* Image Links Section */
.image-links {
  display: flex;
  gap: 10px;
  margin-top: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.preview-image {
  width: calc(100% - 5px);
  max-width: 200px;
  aspect-ratio: 1 / 1;
  border-radius: 5px;
  object-fit: cover;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

/* Small Screen Adjustments */
@media (max-width: 768px) {
  .modal-content {
    width: 90%;
    height: 90%;
  }

  .preview-image {
    width: calc(45% - 10px);
  }
}
</style>
