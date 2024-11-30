<template>
  <div class="demo-page">
    <h1>DEMO: Events/Places</h1>

    <!-- Events Section -->
    <div class="events-section">
      <h2>Upcoming Events</h2>

      <!-- Event 1 -->
      <EventCard
        title="Bubble Tea Book Club"
        organizer="Ming's Bubble Tea"
        description="Monday at 9:00 PM - Join us for a cozy book discussion while enjoying bubble tea."
        avatar-url="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSurYFf7p25tYNhg7WwfLGNtcepYWAzrg77QA&s"
        placeTitle="Ming's Bubble Tea"
        placeDescription="A popular bubble tea spot with waffles and other sweet treats."
        :placeRating="4"
        placeMapsLink="https://maps.app.goo.gl/5dTnNqdJD5RJWngs6"
        placeImagePath="https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg"
        placeExtendedDescription="Enjoy a wide variety of bubble tea flavors and cozy up with a book. Perfect for all book lovers!"
        :placeExtraDetails="['Student discounts available', 'Free WiFi', 'Outdoor seating']"
        :bigPlaceImageLinks="[
          'https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg',
          'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSurYFf7p25tYNhg7WwfLGNtcepYWAzrg77QA&s'
        ]"
        googleMapsEmbedUrl="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96128.42137999351!2d-81.40288484179692!3d41.15606399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88313b29c02bcec7%3A0x89716572f83e24fe!2sMing&#39;s%20Bubble%20Tea!5e0!3m2!1sen!2sus!4v1732436772748!5m2!1sen!2sus"
      />

      <!-- Event 2 -->
      <EventCard
        title="TEMPLATE FOR USE"
        organizer="WHO?"
        description="TIME - INFO."
      placeTitle="PLACE NAME"
        placeDescription="ACTIVITY / BRIEF PLACE INFO."
        :placeRating="200"
        avatar-url="https://i.natgeofe.com/n/4cebbf38-5df4-4ed0-864a-4ebeb64d33a4/NationalGeographic_1468962_3x4.jpg"
        placeMapsLink="https://maps.app.goo.gl/5dTnNqdJD5RJWngs6"
        placeImagePath="https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg"
        placeExtendedDescription="LONG INFO"
        :placeExtraDetails="['IMPORTANT', 'ATTENTION', 'CATCHING']"
        :bigPlaceImageLinks="[
          'https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg',
          'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSurYFf7p25tYNhg7WwfLGNtcepYWAzrg77QA&s'
        ]"
        googleMapsEmbedUrl="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96128.42137999351!2d-81.40288484179692!3d41.15606399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88313b29c02bcec7%3A0x89716572f83e24fe!2sMing&#39;s%20Bubble%20Tea!5e0!3m2!1sen!2sus!4v1732436772748!5m2!1sen!2sus"
      />
    </div>

    <!-- Places Section -->
    <div class="places-section">
      <h2>Popular Places</h2>

      <!-- Place 1 -->
      <PlaceCard
      placeTitle="Ming's Bubble Tea"
      placeDescription="A cozy place for tea lovers. Bubble tea and waffles are our specialty!"
        :placeRating="4"
        placeMapsLink="https://maps.app.goo.gl/5dTnNqdJD5RJWngs6"
        placeImagePath="https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg"
        placeExtendedDescription="Ming's Bubble Tea offers a FOOBAR FOOBAR FOOBAR FOOBAR FOOBAR FOOBAR! FOOBAR FOOBAR FOOBAR FOOBAR FOOBAR FOOBAR       FOOBAR, FOOBARFOOBARFOOBARFOOBAR FOOBAR"
        :placeExtraDetails="['Student discounts available', 'Free WiFi', 'Outdoor seating']"
        :bigPlaceImageLinks="[
          'https://s3-media0.fl.yelpcdn.com/bphoto/laWJlvT5aDYTl-YWc42VIQ/348s.jpg',
          'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSurYFf7p25tYNhg7WwfLGNtcepYWAzrg77QA&s'
        ]"
        googleMapsEmbedUrl="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96128.42137999351!2d-81.40288484179692!3d41.15606399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88313b29c02bcec7%3A0x89716572f83e24fe!2sMing&#39;s%20Bubble%20Tea!5e0!3m2!1sen!2sus!4v1732436772748!5m2!1sen!2sus"
      />
    </div>
  </div>
</template>

<script>
import EventCard from '/src/components/EventCard.vue';
import PlaceCard from '/src/components/PlaceCard.vue';

export default {
  components: {
    EventCard,
    PlaceCard,
  },
};
</script>

<style scoped>
.demo-page {
  padding: 20px;
  font-family: Arial, sans-serif;
  line-height: 1.6;
}

.events-section,
.places-section {
  margin-bottom: 40px;
}

.events-section h2,
.places-section h2 {
  font-size: 2em;
  margin-bottom: 20px;
}

/* Ensure consistent card styling throughout the page */
.event-card,
.place-card {
  margin-bottom: 30px;
}
</style>
