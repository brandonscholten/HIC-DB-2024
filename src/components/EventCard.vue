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
            <!-- Hey Brandon! Update the bigPlaceImageLinks array to add or remove images -->

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
            <!-- EDITABLE: Update googleMapsEmbedUrl prop with an embed URL -->

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
    bigPlaceImageLinks: { type: Array, default: () => [] }, // NEW Method for images
    googleMapsEmbedUrl: { type: String, default: '' }, // NEW Method for Google Maps Embed

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
  margin: 10px 0; /* Added margin to separate rating from other content */
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
  background-color: rgba(0, 0, 0, .8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.modal-content {
  background-color: rgba(221, 221, 221, 1);
  width: 80%;               /* Occupy most of the screen width */
  max-width: 700px;          /* Set a max-width for larger screens */
  height: 80%;              /* Occupy most of the screen height */
  border-radius: 10px;
  padding: 20px;
  overflow-y: auto;         /* Allow scrolling if content overflows */
  display: flex;
  flex-direction: column;
  color: black;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Add shadow for depth */
  position: relative;         /* Ensure content is well-aligned */
}

/* Close Button */
.close-button {
  position: absolute;         /* Positioned at the top-right corner */
  top: 15px;
  right: 15px;
  background-color: #ff5f5f;
  color: white;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
  border-radius: 5px;
  z-index: 10000;             /* Testing: Button stays above everything */
}

/* Image Links Section */
.image-links {
  display: flex;
  gap: 10px;
  margin-top: 20px;
  justify-content: center;
  flex-wrap: wrap; /* wrap to next line (MOBILE) */
}

.preview-image {
  width: calc(100% - 5px);  /* Images take: 30% of space */
  max-width: 200px;           /* Set a maximum size */
  aspect-ratio: 1 / 1;          /* Images aspect-ratio: square */
  border-radius: 5px;
  object-fit: cover;             /* Images fill container proportionally */
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
    width: calc(45% - 10px);  /* Resize (MOBILE) */
  }
}
</style>
